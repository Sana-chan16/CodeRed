@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2>User Management</h2>
                        <p class="text-muted">Manage system users and their roles</p>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="bi bi-person-plus"></i> Add New User
                    </a>
                </div>

                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Search users by name or email..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-select">
                                    <option value="">All Roles</option>
                                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </form>

                    <!-- Users Table -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Last Login</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge {{ $user->isAdmin() ? 'bg-primary' : 'bg-secondary' }}">
                                                {{ $user->isAdmin() ? 'Admin' : 'User' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('users.show', $user) }}" class="btn btn-info">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 