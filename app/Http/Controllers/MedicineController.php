<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Categories;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class MedicineController extends Controller
{
    //

    // Add Medicine start
    public function AddMedicine(){
        $suppliers = Supplier::all();
        $categories = Categories::all();
        return view('backend.medicines.add', compact('suppliers', 'categories'));
    }

    public function storeMedicine(Request $request){
        // Validation
        $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'expiry_date' => 'nullable|date',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name).'-'.Str::random(4);
        // Store Medicine
        Medicine::create([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit' => $request->unit,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock_quantity,
            'low_stock_threshold' => $request->low_stock_threshold,
            'expiry_date' => $request->expiry_date,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);
    

       
        
      
        return redirect()->route('view-medicines')->with('success', 'Medicine added successfully.');
    }


    // View Medicine Start
     public function ViewMedicine(){
            $medicines = Medicine::all();
            return view('backend.medicines.view', compact('medicines'));
    }


        public function editMedicine($id){
            $medicine = Medicine::findOrFail($id);
            $suppliers = Supplier::all();
            $categories = Categories::all();
            return view('backend.medicines.edit', compact('medicine', 'suppliers', 'categories'));
        }


        // Update Medicine Start
         public function updateMedicine(Request $request, $id){
        $medicine = Medicine::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'unit' => 'required|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'low_stock_threshold' => 'nullable|integer|min:0',
            'expiry_date' => 'nullable|date',
            'is_active' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $medicine->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit' => $request->unit,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock_quantity,
            'low_stock_threshold' => $request->low_stock_threshold,
            'expiry_date' => $request->expiry_date,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);

        return redirect()->route('view-medicines')->with('success', 'Medicine updated successfully.');
    }

    public function deleteMedicine($id){
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        return redirect()->route('view-medicines')->with('success', 'Medicine deleted successfully.');
    }

}
