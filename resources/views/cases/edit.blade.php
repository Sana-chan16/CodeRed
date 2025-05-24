@extends(Auth::user()->isAdmin() ? 'layouts.admin' : 'layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Case #{{ $case->id }}</h2>
                </div>

                <div class="card-body">
                    <form action="{{ route('cases.update', $case) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-cases.form :case="$case" />
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Update Case</button>
                                <a href="{{ route('cases.show', $case) }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 