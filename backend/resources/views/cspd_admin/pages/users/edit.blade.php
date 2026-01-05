@extends('cspd_admin.layout.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-user-edit me-2"></i>Edit User</h2>
                <p class="text-muted mb-0">Update user details</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-circle me-2"></i>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user me-1"></i> Name *
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Enter full name"
                                required>
                            @error('name')
                                <span class="error-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Email -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-envelope me-1"></i> Email *
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address"
                                required>
                            @error('email')
                                <span class="error-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Password -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock me-1"></i> New Password
                            </label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Leave blank to keep current password">
                            <small class="text-muted">Leave blank if you don't want to change the password</small>
                            @error('password')
                                <span class="error-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock me-1"></i> Confirm New Password
                            </label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm new password">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="btn-form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
