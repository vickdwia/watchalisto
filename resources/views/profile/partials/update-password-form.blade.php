<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input id="current_password" type="password" name="current_password" class="form-control" required>
        @error('current_password') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input id="password" type="password" name="password" class="form-control" required>
        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Password</button>
</form>
