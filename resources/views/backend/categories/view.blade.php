@extends('backend.common.master')

@section('content')


<div class="content-page">
        <div class="content">
          <!-- Start Content-->
          <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Categories</h4>
              </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Category Details</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-dark table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Description</th>
                                                        <th >Update</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($categories as $category)
                                                        <tr>
                                                            <th scope="row">{{ $category->id }}</th>
                                                            <td>{{ $category->name }}</td>
                                                            <td>{{ $category->description }}</td>
                                                            <td><a href={{ route('categories.edit',$category->id) }} class="btn btn-sm btn-warning">Update</a></td>
                                                            <td><a href={{ route('categories.delete',$category->id) }} class="btn btn-sm btn-danger">Delete</a></td>
                                        
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