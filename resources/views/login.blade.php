@extends('layouts.app')

@section('title', 'Login - Watchalisto')

@section('content')
<div class="flex justify-center items-center min-h-[80vh] px-4">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6 text-[#3b2e2a]">Login to Watchalisto</h1>

        <form action="#" method="POST" class="space-y-5">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5c715e]" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5c715e]" required>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="mr-2">
                <label for="remember" class="text-sm">Remember me</label>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-[#5c715e] text-white py-2 rounded-lg hover:bg-[#4e5f50] transition">Login</button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#5c715e] hover:underline">Sign Up</a>
        </p>
    </div>
</div>
@endsection