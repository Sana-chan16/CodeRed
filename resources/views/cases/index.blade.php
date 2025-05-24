@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Case Management</h2>
                    <p class="text-muted">View and manage all reported cases and investigations</p>
                </div>

                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form action="{{ route('cases.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Search cases by report number, type, reporter, or location..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-select">
                                    <option value="">All Statuses</option>
                                    {{-- Add options dynamically based on your statuses --}}
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="under_investigation" {{ request('status') === 'under_investigation' ? 'selected' : '' }}>Under Investigation</option>
                                    <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="priority" class="form-select">
                                    <option value="">All Priorities</option>
                                     {{-- Add options dynamically based on your priorities --}}
                                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="critical" {{ request('priority') === 'critical' ? 'selected' : '' }}>Critical</option>
                                </select>
                            </div>
                            {{-- Date filters removed for simplicity based on image --}}
                             <div class="col-md-2" style="display: none;">
                                <div class="form-group">
                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
                                </div>
                            </div>
                            <div class="col-md-2" style="display: none;">
                                <div class="form-group">
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
                                </div>
                            </div>
                            <div class="col-md-auto" style="display: none;">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </div>
                         <div class="row g-3 align-items-center mt-2">
                             <div class="col-md-auto">
                                  <button type="submit" class="btn btn-primary">Apply Filters</button>
                             </div>
                         </div>
                    </form>

                    <!-- Cases Table -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('cases.index', array_merge(request()->query(), ['sort_by' => 'id', 'sort_direction' => request('sort_direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                            Report #
                                            @if(request('sort_by') === 'id')
                                                <i class="fas fa-sort-{{ request('sort_direction') === 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Date</th>
                                    <th>Incident Type</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Reported By</th>
                                    <th>Location</th>
                                    <th>Assigned To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cases as $case)
                                    <tr>
                                        <td>RPT-{{ str_pad($case->id, 3, '0', STR_PAD_LEFT) }}-{{ $case->created_at->format('Y') }}</td>
                                        <td>{{ $case->incident_date->format('m/d/Y') }}</td>
                                        <td>{{ $case->reasons_for_reporting }}</td>
                                        <td>
                                            @php
                                                $statusClass = '';
                                                switch(strtolower($case->status ?? 'active')) { // Assuming a status field exists or default to active
                                                    case 'active':
                                                        $statusClass = 'bg-primary';
                                                        break;
                                                    case 'under investigation':
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                    case 'resolved':
                                                        $statusClass = 'bg-success';
                                                        break;
                                                    default:
                                                        $statusClass = 'bg-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $case->status ?? 'Active' }}</span> {{-- Display status field or default --}}
                                        </td>
                                         <td>
                                            @php
                                                $priorityClass = '';
                                                switch(strtolower($case->priority ?? 'medium')) { // Assuming a priority field exists or default to medium
                                                    case 'high':
                                                        $priorityClass = 'bg-danger';
                                                        break;
                                                    case 'medium':
                                                        $priorityClass = 'bg-warning';
                                                        break;
                                                    case 'critical': // Assuming critical exists and is red like in the image
                                                        $priorityClass = 'bg-danger'; // Using danger for critical as in image
                                                        break;
                                                    default:
                                                        $priorityClass = 'bg-secondary';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{ $priorityClass }}">{{ $case->priority ?? 'Medium' }}</span> {{-- Display priority field or default --}}
                                        </td>
                                        <td>{{ $case->prepared_by }}</td> {{-- Assuming prepared_by is the reporter --}}
                                        <td>{{ $case->incident_place }}</td>
                                        <td>{{ $case->acknowledged_by ?? 'Unassigned' }}</td> {{-- Assuming acknowledged_by is assigned_to --}}
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('cases.show', $case) }}" class="btn btn-sm btn-info" title="View"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('cases.edit', $case) }}" class="btn btn-sm btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                                {{-- Delete form remains as a button for confirmation --}}
                                                <form action="{{ route('cases.destroy', $case) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this case?')" title="Delete"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No cases found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $cases->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 