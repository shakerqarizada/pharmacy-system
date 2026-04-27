@extends('backend.common.master')

@section('content')


<div class="content-page">
        <div class="content">
          <!-- Start Content-->
          <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Customers</h4>
              </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Customer Details</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-dark table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Address</th>
                                    
                                                        <th >Update</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customers as $customer)
                                                        <tr>
                                                            <th scope="row">{{ $customer->id }}</th>
                                                            <td>{{ $customer->name }}</td>
                                                            <td>{{ $customer->phone }}</td>
                                                            <td>{{ $customer->email }}</td>
                                                            <td>{{ $customer->address }}</td>
                                                            <td><a href={{ route('customer.edit',$customer->id) }} class="btn btn-sm btn-warning">Update</a></td>
                                                            <td><a href={{ route('customer.delete',$customer->id) }} class="btn btn-sm btn-danger">Delete</a></td>
                                        
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