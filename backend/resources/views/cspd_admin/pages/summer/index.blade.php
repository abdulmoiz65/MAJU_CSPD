@extends('cspd_admin.layout.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="table-container">
            <div class="table-header">
                <div>
                    <h2><i class="fas fa-sun me-2"></i>Summer Schools</h2>
                    <p class="text-muted mb-0">Manage all summer school programs</p>
                </div>
                <a href="{{ route('admin.summer.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Add New Summer School
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Title</th>
                            <th width="20%">Date & Duration</th>
                            <th width="15%">Fees</th>
                            <th width="10%">Status</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schools as $school)
                            <tr>
                                <td class="fw-bold">{{ $school->id }}</td>
                                <td>
                                    <h6 class="mb-1" style="font-size: 14px; color: #1d2f6f;">
                                        {{ Str::limit($school->title, 50) }}
                                    </h6>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        <i class="fas fa-calendar text-primary me-1"></i>
                                        <strong>{{ $school->display_date ?? 'N/A' }}</strong>
                                    </div>
                                    <div class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $school->duration ?? 'N/A' }} | {{ $school->total_hours ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-warning">
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        <strong>{{ $school->formatted_fees }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $school->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($school->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.summer.edit', $school->id) }}"
                                            class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.summer.destroy', $school->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this summer school?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No summer schools found. <a href="{{ route('admin.summer.create') }}">Add one now</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $schools->links() }}
            </div>
        </div>
    </div>
@endsection
