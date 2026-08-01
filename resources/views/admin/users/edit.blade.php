@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card ag-card">
                <div class="card-header">
                    <h5 class="mb-0">{{ isset($user) ? 'Edit User' : 'Create New User' }}</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}"
                        method="POST">
                        @csrf
                        @if(isset($user)) @method('PUT') @endif

                        <div class="mb-4">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-control"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
                            @if(isset($user))
                                <small class="text-muted">Leave blank to keep current password</small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">System Role</label>
                            <select name="role" class="form-select">
                                <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>User
                                </option>
                                <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>
                                    Admin</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between pt-4 border-top">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit"
                                class="btn btn-primary px-5">{{ isset($user) ? 'Update User' : 'Create User' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection