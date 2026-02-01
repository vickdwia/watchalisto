<form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure you want to delete your account?');">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">Delete Account</button>
</form>
