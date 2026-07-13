@extends('backend.common.master')

@section('content')
    <div class="content-page">
        <div class="content">
            <div class="container-xxl">
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">Profile Settings</h4>
                        <div class="text-muted fs-13 mt-1">Manage your account profile and security settings</div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-xl-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <div class="avatar-lg mx-auto mb-3">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                        <img width="100%" height="100%" class="rounded-circle" src="{{ $user->image }}" alt="">
                                    </div>
                                </div>
                                <h5 class="fw-semibold">{{ $user->name }}</h5>
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="user" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Profile Information</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-xl-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-dark rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="lock" class="widgets-icons"></i>
                                    </div>
                                    <h5 class="card-title mb-0">Update Password</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card h-100 border-danger">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div class="border border-danger rounded-2 me-2 widget-icons-sections">
                                        <i data-feather="trash-2" class="widgets-icons text-danger"></i>
                                    </div>
                                    <h5 class="card-title mb-0 text-danger">Delete Account</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
