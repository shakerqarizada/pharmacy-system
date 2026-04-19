@extends('backend.common.master')

@section('content')


<div class="content-page">
        <div class="content">
          <!-- Start Content-->
          <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Suppliers</h4>
              </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Supplier Details</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-dark table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Contact Person</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th >Update</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($suppliers as $supplier)
                                                        <tr>
                                                            <th scope="row">{{ $supplier->id }}</th>
                                                            <td>{{ $supplier->name }}</td>
                                                            <td>{{ $supplier->contact_person }}</td>
                                                            <td>{{ $supplier->phone }}</td>
                                                            <td>{{ $supplier->email }}</td>
                                                            <td>{{ $supplier->address }}</td>
                                                            <td><a href={{ route('suppliers.edit',$supplier->id) }} class="btn btn-sm btn-warning">Update</a></td>
                                                            <td><a href={{ route('suppliers.delete',$supplier->id) }} class="btn btn-sm btn-danger">Delete</a></td>
                                        
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