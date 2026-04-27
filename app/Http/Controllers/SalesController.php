<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;

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
            // What is this?
            'items.*.medicine_id' => 'required|exists:medicines,id',
            'items.*.unit_price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.subtotal' => 'required|numeric',
        ]);
        // What is This?
        \DB::beginTransaction();
        try {
            // Save main sale
            $sale = \App\Models\Sale::create([
                'invoice_number' => $validated['invoice_number'],
                'user_id' => $validated['user_id'],
                // You may want to resolve customer_id if you have a customers table
                'customer_id' => null,
                'subtotal' => $validated['subtotal'],
                'discount' => $validated['discount_amount'],
                'total' => $validated['total'],
                'paid' => $validated['paid'],
                'change' => $validated['change'],
                'sold_at' => $validated['sold_date'],
            ]);

            // Save sale items
            foreach ($validated['items'] as $item) {
                \App\Models\SaleItem::create([
                    'sale_id' => $sale->id,
                    'medicine_id' => $item['medicine_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['subtotal'],
                ]);

                // Update medicine stock
                $medicine = \App\Models\Medicine::find($item['medicine_id']);
                $medicine->decrement('stock', $item['quantity']);
            }

            \DB::commit();
            return redirect()->route('view-sales')->with('success', 'Sale added successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function viewSales()
    {
        // Retrieve and display sales
    }

    public function editSale($id)
    {
        // Retrieve the sale and show the edit form
    }

    public function updateSale(Request $request, $id)
    {
        // Validate and update the sale
    }
    public function deleteSale($id)
    {
        // Delete the sale
    }
}
