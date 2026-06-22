<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function UserIndex()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $expiringSoonDate = Carbon::now()->addDays(30);

        $todaySales = Sale::whereDate('sold_at', $today)->sum('total');
        $todaySaleCount = Sale::whereDate('sold_at', $today)->count();
        $monthSales = Sale::where('sold_at', '>=', $startOfMonth)->sum('total');
        $monthSaleCount = Sale::where('sold_at', '>=', $startOfMonth)->count();
        $totalMedicines = Medicine::count();
        $activeMedicines = Medicine::where('is_active', true)->count();
        $lowStockCount = Medicine::whereColumn('stock', '<=', 'low_stock_threshold')->count();
        $expiringSoonCount = Medicine::whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [$today, $expiringSoonDate])
            ->count();

        $inventoryValue = Medicine::selectRaw('COALESCE(SUM(stock * purchase_price), 0) as value')->value('value');
        $todayProfit = $this->estimateProfitForSalesSince($today);
        $monthProfit = $this->estimateProfitForSalesSince($startOfMonth);

        $lowStockMedicines = Medicine::with(['category', 'supplier'])
            ->whereColumn('stock', '<=', 'low_stock_threshold')
            ->orderBy('stock')
            ->limit(6)
            ->get();

        $expiringMedicines = Medicine::with('supplier')
            ->whereNotNull('expiry_date')
            ->whereBetween('expiry_date', [$today, $expiringSoonDate])
            ->orderBy('expiry_date')
            ->limit(6)
            ->get();

        $topSellingMedicines = SaleItem::with('medicine')
            ->select('medicine_id')
            ->selectRaw('SUM(quantity) as total_quantity, SUM(subtotal) as total_revenue')
            ->groupBy('medicine_id')
            ->orderByDesc('total_quantity')
            ->limit(6)
            ->get();

        $cashierPerformance = Sale::with('cashier')
            ->select('user_id')
            ->selectRaw('COUNT(*) as sales_count, SUM(total) as sales_total')
            ->where('sold_at', '>=', $startOfMonth)
            ->groupBy('user_id')
            ->orderByDesc('sales_total')
            ->limit(5)
            ->get();

        $recentSales = Sale::with(['cashier', 'items'])
            ->latest('sold_at')
            ->limit(6)
            ->get();

        $currentYearSales = Sale::whereBetween('sold_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->get(['sold_at', 'total'])
            ->groupBy(fn ($sale) => $sale->sold_at->format('n'))
            ->map(fn ($sales) => $sales->sum('total'));

        $monthlySalesLabels = [];
        $monthlySalesData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlySalesLabels[] = Carbon::create(now()->year, $month, 1)->format('M');
            $monthlySalesData[] = round((float) ($currentYearSales[$month] ?? 0), 2);
        }

        return view('backend.index', compact(
            'todaySales',
            'todaySaleCount',
            'monthSales',
            'monthSaleCount',
            'totalMedicines',
            'activeMedicines',
            'lowStockCount',
            'expiringSoonCount',
            'inventoryValue',
            'todayProfit',
            'monthProfit',
            'lowStockMedicines',
            'expiringMedicines',
            'topSellingMedicines',
            'cashierPerformance',
            'recentSales',
            'monthlySalesLabels',
            'monthlySalesData'
        ));
    }

    private function estimateProfitForSalesSince(Carbon $date): float
    {
        return (float) SaleItem::query()
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->join('medicines', 'sale_items.medicine_id', '=', 'medicines.id')
            ->where('sales.sold_at', '>=', $date)
            ->selectRaw('COALESCE(SUM(sale_items.subtotal - (sale_items.quantity * medicines.purchase_price)), 0) as profit')
            ->value('profit');
    }

    public function AddUser()
    {
        return view('backend.users.add');
    }

    public function ViewUser()
    {
        $users = User::all();
        return view('backend.users.view', compact('users'));
    }

    public function storeUser(Request $request)
    {


        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,cashier,pharmacist',

        ]);

        $image = $request->file('image');
        $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('backend/assets/images/users/'), $imageName);
        $finalImage = 'backend/assets/images/users/' . $imageName;


        // Create a new user using the validated data
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            'image' => $finalImage,
        ]);

        // Redirect to a desired location with a success message
        return redirect()->route('view-users')->with('success', 'User created successfully.');
    }


    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,cashier,pharmacist',
        ]);

        if ($request->hasFile('image')) {
            if (file_exists($user->image)) {
                unlink($user->image);
            }

            $image = $request->file('image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('backend/assets/images/users/'), $imageName);
            $finalImage = 'backend/assets/images/users/' . $imageName;
        }

        // Update the user with the validated data
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'image' => isset($finalImage) ? $finalImage : $user->image,
        ]);

        // Update the password if it's provided
        if (!empty($validatedData['password'])) {
            $user->update([
                'password' => bcrypt($validatedData['password']),
            ]);
        }

        // Redirect to a desired location with a success message
        return redirect()->route('view-users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (file_exists($user->image)) {
            unlink($user->image);
        }
        $user->delete();
        return redirect()->route('view-users')->with('success', 'User deleted successfully.');
    }

    // User End


    // Categories Start

    public function ViewCategory()
    {
        $categories = Categories::all();
        return view('backend.categories.view', compact('categories'));
    }

    public function AddCategory()
    {
        return view('backend.categories.add');
    }

    public function storeCategory(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
        ]);

        // Create a new category using the validated data
        Categories::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description']
        ]);

        // Redirect to a desired location with a success message
        return redirect()->route('view-categories')->with('success', 'Category created successfully.');
    }


    public function editCategory($id)
    {
        $category = Categories::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

        ]);

        // Update the user with the validated data
        $category->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);



        // Redirect to a desired location with a success message
        return redirect()->route('view-categories')->with('success', 'Category updated successfully.');
    }

    public function deleteCategory($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('view-categories')->with('success', 'Category deleted successfully.');
    }

    // Categories End

    // Suppliers Start

    public function ViewSupplier()
    {
        $suppliers = Supplier::all();
        return view('backend.suppliers.view', compact('suppliers'));
    }

    public function AddSupplier()
    {
        return view('backend.suppliers.add');
    }

    public function storeSupplier(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'string|max:255',
            'phone' => 'string|max:20',
            'email' => 'email|max:255|unique:suppliers',
            'address' => 'string|max:255',

        ]);

        // Create a new supplier using the validated data
        Supplier::create([
            'name' => $validatedData['name'],
            'contact_person' => $validatedData['contact_person'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address']
        ]);

        // Redirect to a desired location with a success message
        return redirect()->route('view-suppliers')->with('success', 'Supplier created successfully.');
    }


    public function editSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.suppliers.edit', compact('supplier'));
    }
    public function updateSupplier(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'string|max:255',
            'phone' => 'string|max:20',
            'email' => 'email|max:255',
            'address' => 'string|max:255',
        ]);

        // Update the user with the validated data
        $supplier->update([
            'name' => $validatedData['name'],
            'contact_person' => $validatedData['contact_person'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
        ]);



        // Redirect to a desired location with a success message
        return redirect()->route('view-suppliers')->with('success', 'Supplier updated successfully.');
    }

    public function deleteSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('view-suppliers')->with('success', 'Supplier deleted successfully.');
    }

    // Categories End
}
