@extends('backend.common.master')

@section('content')




<div class="content-page">
        <div class="content">
          <!-- Start Content-->
          <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Medicines</h4>
              </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Medicine Details</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-dark table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th>Supplier</th>
                                                        <th>Unit</th>
                                                        <th>Purchase Price</th>
                                                        <th>Selling Price</th>
                                                        <th>Stock Quantity</th>
                                                        <th>Low Stock Threshold</th>
                                                        <th>Expiry Date</th>
                                                        <th>Is Active</th>

                                                        <th>Description</th>
                                                        <th>Update</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($medicines as $medicine)
                                                        <tr>
                                                            <th>{{ $medicine->id }}</th>
                                                            <td>{{ $medicine->name }}</td>
                                                            <td>{{ $medicine->category->name }}</td>
                                                            <td>{{ $medicine->supplier->name }}</td>
                                                            <td>{{ $medicine->unit }}</td>
                                                            <td>{{ $medicine->purchase_price }}</td>
                                                            <td>{{ $medicine->selling_price }}</td>
                                                            <td>{{ $medicine->stock }}</td>
                                                            <td>{{ $medicine->low_stock_threshold }}</td>
                                                            <td>{{ $medicine->expiry_date }}</td>
                                                            <td>{{ $medicine->is_active ? "Yes" : "No" }}</td>
                                                            <td>{{ $medicine->description }}</td>
                                                            <td><a href={{ route('medicines.edit',$medicine->id) }} class="btn btn-sm btn-warning">Update</a></td>
                                                            <td><a href={{ route('medicines.delete',$medicine->id) }} class="btn btn-sm btn-danger">Delete</a></td>
                                        
                                                        </tr>
                                                        
                                                    @endforeach
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
          </div>
        </div>
        <!-- End Page-content -->
@endsection