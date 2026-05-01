<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{

    //
    public function AddSales()
    {
        $users = User::all();
        $medicines = Medicine::all();
        return view('backend.sales.add', compact('users', 'medicines'));
    }
    public function storeSales(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|unique:sales,invoice_number',
            'user_id' => 'required|exists:users,id',
            'customer' => 'required|string',
            'subtotal' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'total' => 'required|numeric',
            'paid' => 'required|numeric',
            'change' => 'required|numeric',
            'sold_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.unit_price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.subtotal' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {
            // Find or create customer by name
            $customer = Customer::firstOrCreate([
                'name' => $validated['customer'],
            ]);
            // Save main sale
            $sale = Sale::create([
                'invoice_number' => $validated['invoice_number'],
                'user_id' => $validated['user_id'],
                'customer_id' => $customer->id,
                'subtotal' => $validated['subtotal'],
                'discount' => $validated['discount_amount'],
                'total' => $validated['total'],
                'paid' => $validated['paid'],
                'change' => $validated['change'],
                'sold_at' => $validated['sold_date'],
            ]);

            // Save sale items
            foreach ($validated['items'] as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $item['medicine_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                ]);
                // Update medicine stock
                $medicine = Medicine::find($item['medicine_id']);
                if ($medicine) {
                    $medicine->stock -= $item['quantity'];
                    $medicine->save();
                }
            }

            DB::commit();
            return redirect()->route('view-sales')->with('success', 'Sale added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function viewSales()
    {
        $sales = Sale::with(['cashier', 'customer', 'items.medicine'])->orderBy('created_at', 'desc')->get();
        return view('backend.sales.view', compact('sales'));
    }

    public function editSale($id)
    {
        $sale = Sale::with(['items.medicine', 'customer', 'cashier'])->findOrFail($id);
        $users = User::all();
        $medicines = Medicine::all();
        $customers = Customer::all();
        return view('backend.sales.edit', compact('sale', 'users', 'medicines', 'customers'));
    }

    public function updateSale(Request $request, $id)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|unique:sales,invoice_number,' . $id,
            'user_id' => 'required|exists:users,id',
            'customer' => 'required|string',
            'subtotal' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'total' => 'required|numeric',
            'paid' => 'required|numeric',
            'change' => 'required|numeric',
            'sold_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.unit_price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.subtotal' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {
            $sale = Sale::findOrFail($id);
            $customer = Customer::firstOrCreate([
                'name' => $validated['customer'],
            ]);
            $sale->update([
                'invoice_number' => $validated['invoice_number'],
                'user_id' => $validated['user_id'],
                'customer_id' => $customer->id,
                'subtotal' => $validated['subtotal'],
                'discount' => $validated['discount_amount'],
                'total' => $validated['total'],
                'paid' => $validated['paid'],
                'change' => $validated['change'],
                'sold_at' => $validated['sold_date'],
            ]);

            // Remove old sale items and restore stock
            foreach ($sale->items as $item) {
                $medicine = Medicine::find($item->medicine_id);
                if ($medicine) {
                    $medicine->stock += $item->quantity;
                    $medicine->save();
                }
                $item->delete();
            }

            // Add new sale items and update stock
            foreach ($validated['items'] as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $item['medicine_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                ]);
                $medicine = Medicine::find($item['medicine_id']);
                if ($medicine) {
                    $medicine->stock -= $item['quantity'];
                    $medicine->save();
                }
            }

            DB::commit();
            return redirect()->route('view-sales')->with('success', 'Sale updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteSale($id)
    {
        DB::beginTransaction();
        try {
            $sale = Sale::findOrFail($id);
            // Restore stock
            foreach ($sale->items as $item) {
                $medicine = Medicine::find($item->medicine_id);
                if ($medicine) {
                    $medicine->stock += $item->quantity;
                    $medicine->save();
                }
                $item->delete();
            }
            $sale->delete();
            DB::commit();
            return redirect()->route('view-sales')->with('success', 'Sale deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
