<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
