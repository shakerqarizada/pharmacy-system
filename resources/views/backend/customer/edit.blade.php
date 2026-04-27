@extends('backend.common.master')

@section('content')
    <div class="content-page">
        <div class="content">
          <!-- Start Content-->
          <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
              <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Update User</h4>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-0">User Details</h5>
                </div><!-- end card header -->
        
                                    <div class="card-body">
                                        <form class="row g-3" action={{ route('customer.update', $customer->id) }} method="POST">
                                            @csrf
                                            <input type="hidden" value={{ $customer->id }} >
                                            <div class="col-md-6">
                                                <label for="validationServer01" class="form-label">Name</label>
                                                <input type="text" name="name" value={{ $customer->name }} class="form-control " id="" value="" required placeholder="Name">
                                            </div>
                                            <br>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Phone</label>
                                                <div class="input-group has-validation">
                                                  
                                                    <input type="text" value={{ $customer->phone }} name="phone" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServer03" class="form-label">Email</label>
                                                <input type="text" name="email" value={{ $customer->email }} class="form-control " id="validationServer03" value="" required placeholder="Email">
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <label for="validationServer05" class="form-label">Address</label>
                                                <textarea name="address" id="validationServer05Feedback" class="form-control" cols="30" rows="5">{{ $customer->address }}</textarea>                                                
                                            </div>
                                        
                                            <div class="col-12">
                                                <button class="btn btn-success" type="submit">Update Customer</button>
                                            </div>
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
 </div>
</div>


@endSection