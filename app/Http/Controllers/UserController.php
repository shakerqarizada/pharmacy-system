<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use App\Models\Supplier;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function UserIndex()
    {
        return view('backend.index');
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
