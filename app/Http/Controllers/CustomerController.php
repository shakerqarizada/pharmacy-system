<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function AddCustomer(){
        return view('backend.customer.add');
    }
    public function storeCustomer(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Create a new customer record

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('view-customers')->with('success', 'Customer added successfully!');
    }

    public function ViewCustomer(){
        $customers = Customer::all();
        return view('backend.customer.view', compact('customers'));
    }

    public function editCustomer($id){
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit', compact('customer'));
    }
    public function updateCustomer(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:customers,email,',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('view-customers')->with('success', 'Customer updated successfully!');
    }

    public function deleteCustomer($id){
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('view-customers')->with('success', 'Customer deleted successfully!');
    }
}
