@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h2>Create New User</h2>
                        <p class="text-muted">Add a new user to the system</p>
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <x-users.form />
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Create User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 