<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="update_password_current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
        @error('updatePassword.current_password')
            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
        @error('updatePassword.password')
            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
        @error('updatePassword.password_confirmation')
            <div class="text-danger fs-13 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex align-items-center gap-2">
        <button type="submit" class="btn btn-primary">
            <i data-feather="save" style="height: 16px; width: 16px"></i>
            Update Password
        </button>

        @if (session('status') === 'password-updated')
            <span class="text-success fs-13">
                <i data-feather="check-circle" style="height: 14px; width: 14px"></i>
                Password updated successfully.
            </span>
        @endif
    </div>
</form>
