@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Create New Case</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('cases.store') }}" method="POST">
                        @csrf
                        <x-cases.form />
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Create Case</button>
                                <a href="{{ route('cases.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 