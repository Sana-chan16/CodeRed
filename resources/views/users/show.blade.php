@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2>User Details</h2>
                        <p class="text-muted">View user information</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit User
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                <i class="bi bi-trash"></i> Delete User
                            </button>
                        </form>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Basic Information</h4>
                            <table class="table">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role:</th>
                                    <td>
                                        <span class="badge {{ $user->isAdmin() ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ $user->isAdmin() ? 'Admin' : 'User' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h4>Account Information</h4>
                            <table class="table">
                                <tr>
                                    <th>Created:</th>
                                    <td>{{ $user->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated:</th>
                                    <td>{{ $user->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Login:</th>
                                    <td>{{ $user->last_login_at ? $user->last_login_at->format('M d, Y H:i') : 'Never' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 