@extends('backend.common.master')

@section('content')
    <div class="content-page">
        <div class="content">
          <!-- Start Content-->
          <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Add Medicine</h4>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">Medicine Details</h5>
                </div><!-- end card header -->

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
                                    <div class="card-body">
                                        <form class="row g-3" action="{{ route('medicines.store') }}" method="POST">
                                            @csrf
                                            <div class="col-md-12">
                                                <label for="validationServer01" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control " id="" value="" required placeholder="Name">
                                            </div>
                                          
                                                <div class="col-md-6">
                                                    <label for="validationServerUsername" class="form-label">Category</label>
                                                    <div class="input-group has-validation">
                                                        <select name="category_id" class="form-control " id="" required>
                                                            <option value="" selected disabled>Select Category</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                         </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationServerUsername" class="form-label">Supplier</label>
                                                    <div class="input-group has-validation">
                                                        <select name="supplier_id" class="form-control " id="" required>
                                                            <option value="" selected disabled>Select Supplier</option>
                                                            @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                            @endforeach
                                                         </select>
                                                    </div>
                                                </div>
                                                            
                                                  
                                                
                                                
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Unit</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" name="unit" class="form-control " id="" value="" required placeholder="Unit">
                                                    
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Purchase Price</label>
                                                <div class="input-group has-validation">
                                                  
                                                    <input type="Number" step="0.01" name="purchase_price" class="form-control " id="" value="" required placeholder="Purchase Price">
                                                    
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Selling Price</label>
                                                <div class="input-group has-validation">
                                                  
                                                    <input type="Number" step="0.01" name="selling_price" class="form-control " id="" value="" required placeholder="Selling Price">
                                                    
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Stock Quantity</label>
                                                <div class="input-group has-validation">
                                                  
                                                    <input type="Number" name="stock_quantity" class="form-control " id="" value="" required placeholder="Stock Quantity">
                                                    
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Low Stock Threshold</label>
                                                <div class="input-group has-validation">
                                                    <input type="Number" name="low_stock_threshold" class="form-control " id="" value="" required placeholder="Low Stock Threshold">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Expiry Date</label>
                                                <div class="input-group has-validation">
                                                    <input type="Date" name="expiry_date" class="form-control " id="" value=""  placeholder="Expiry Date">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Description
                                                </label>
                                                <div class="input-group has-validation">
                                                    <input type="Text" name="description" class="form-control " id="" value=""  placeholder="Description">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Is Active
                                                </label>
                                                <div class="input-group has-validation">
                                                    <select name="is_active" class="form-control " id="" required>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                          
                                           
                                            
                                        
                                            <div class="col-12">
                                                <button class="btn btn-success" type="submit">Add Medicine</button>
                                            </div>
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
 </div>
</div>


@endSection