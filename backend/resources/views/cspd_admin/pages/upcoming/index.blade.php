@extends('cspd_admin.layout.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="table-container">
            <div class="table-header">
                <div>
                    <h2><i class="fas fa-calendar-alt me-2"></i>Upcoming Programs</h2>
                    <p class="text-muted mb-0">Manage all upcoming training programs</p>
                </div>
                <a href="{{ route('admin.upcoming.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Add New Program
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
                            <th width="25%">Title</th>
                            <th width="20%">Date & Duration</th>
                            <th width="15%">Timing & Fees</th>
                            <th width="10%">Status</th>
                            <th width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $program)
                            <tr>
                                <td class="fw-bold">{{ $program->id }}</td>
                                <td>
                                    <h6 class="mb-1" style="font-size: 14px; color: #1d2f6f;">
                                        {{ Str::limit($program->title, 50) }}
                                    </h6>
                                    <small class="text-muted">
                                        {{ Str::limit($program->overview, 70) }}
                                    </small>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        <i class="fas fa-calendar text-primary me-1"></i>
                                        <strong>{{ $program->display_date }}</strong>
                                    </div>
                                    <div class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $program->duration }} | {{ $program->total_hours }}
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        <i class="fas fa-clock text-success me-1"></i>
                                        {{ $program->timing }}
                                    </div>
                                    <div class="text-warning">
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        <strong>{{ $program->formatted_fees }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $program->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($program->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.upcoming.show', $program->id) }}"
                                            class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.upcoming.edit', $program->id) }}"
                                            class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Edit Program">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.upcoming.destroy', $program->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this program?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete Program">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-plus fa-3x text-muted mb-3"></i>
                                        <h5>No Upcoming Programs Found</h5>
                                        <p class="text-muted">Get started by creating your first upcoming program.</p>
                                        <a href="{{ route('admin.upcoming.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Create Program
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($programs->hasPages())
                    <div class="d-flex justify-content-center mt-4">


                        <!-- Custom Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Previous Page Link --}}
                                <li class="page-item {{ $programs->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $programs->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                {{-- Page Numbers --}}
                                @for ($i = 1; $i <= $programs->lastPage(); $i++)
                                    <li class="page-item {{ $programs->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $programs->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Next Page Link --}}
                                <li class="page-item {{ !$programs->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $programs->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>



                    </div>
                @endif
                <div class="text-muted">
                    Showing {{ $programs->firstItem() }} to {{ $programs->lastItem() }} of
                    {{ $programs->total() }}
                    entries
                </div>
            </div>


        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection
