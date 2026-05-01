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
                                        <form class="row g-3" action={{ route('user.update', $user->id) }} method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value={{ $user->id }} >
                                            <div class="col-md-6">
                                                <label for="validationServer01" class="form-label">Name</label>
                                                <input type="text" name="name" value={{ $user->name }} class="form-control " id="" value="" required placeholder="Name">
                                            </div>
                                            <br>
                                            <div class="col-md-6">
                                                <label for="validationServerUsername" class="form-label">Email</label>
                                                <div class="input-group has-validation">
                                                  
                                                    <input type="email" value={{ $user->email }} name="email" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServer03" class="form-label">Role</label>
                                                <select class="form-select" name="role" id="validationServer03" aria-describedby="validationServer03Feedback" required>
                                                    <option selected disabled value="">Choose</option>
                                                    <option {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                                    <option {{ $user->role === 'pharmacist' ? 'selected' : '' }}>pharmacist</option>
                                                    <option {{ $user->role === 'cashier' ? 'selected' : '' }}>cashier</option>
                                                </select>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <label for="validationServer05" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="new password" id="validationServer05" aria-describedby="validationServer05Feedback">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="validationServer05" class="form-label">Image</label>
                                                <input type="file" name="image" class="form-control" id="validationServer05" aria-describedby="validationServer05Feedback">
                                            </div>
                                        
                                            <div class="col-12">
                                                <button class="btn btn-success" type="submit">Update User</button>
                                            </div>
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
 </div>
</div>


@endSection