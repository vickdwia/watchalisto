@extends('layouts.profile')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #fff;
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, sans-serif;
    }

    .glass-card {
        background: rgba(17, 25, 40, 0.5);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #14b8a6;
        margin-bottom: 1rem;
    }

    .form-label {
        color: #cbd5e1;
        font-weight: 500;
    }

    .form-control {
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255,255,255,0.1);
        color: white;
        border-radius: 8px;
        padding: 0.625rem 0.75rem;
    }

    .form-control:focus {
        background: rgba(15, 23, 42, 0.7);
        color: white;
        border-color: #14b8a6;
        box-shadow: 0 0 0 0.25rem rgba(20, 184, 166, 0.25);
    }

    .form-control::placeholder {
        color: #64748b;
    }

    .invalid-feedback {
        color: #f87171;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .btn-primary {
        background-color: #14b8a6;
        border-color: #14b8a6;
        color: white;
        font-weight: 500;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background-color: #0d9d8e;
        border-color: #0d9d8e;
    }

    .btn-outline-danger {
        color: #f87171;
        border-color: rgba(248, 113, 113, 0.3);
        background: transparent;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-outline-danger:hover {
        background: rgba(248, 113, 113, 0.1);
        border-color: #f87171;
        color: #f87171;
    }
</style>
@endpush

@section('content')
<h2 class="h4 fw-bold mb-4 text-white">Profile Settings</h2>

    <div class="row g-4">
        <!-- Personal Information -->
        <div class="col-12">
            <div class="glass-card p-4">
                <h5 class="section-title">Personal Information</h5>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password -->
        <div class="col-12">
            <div class="glass-card p-4">
                <h5 class="section-title">Password</h5>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="col-12">
            <div class="glass-card p-4">
                <h5 class="section-title text-danger">Danger Zone</h5>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection