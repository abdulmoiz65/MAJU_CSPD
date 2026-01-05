@extends('cspd_admin.layout.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="table-container">
            <div class="table-header">
                <div>
                    <h2><i class="fas fa-users me-2"></i>Users</h2>
                    <p class="text-muted mb-0">Manage all admin users</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle me-2"></i>Add New User
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
                            <th width="25%">Name</th>
                            <th width="30%">Email</th>
                            <th width="20%">Created At</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="fw-bold">{{ $user->id }}</td>
                                <td>
                                    <h6 class="mb-0" style="font-size: 14px; color: #1d2f6f;">
                                        {{ $user->name }}
                                    </h6>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <i class="fas fa-calendar text-primary me-1"></i>
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete User">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-user-plus fa-3x text-muted mb-3"></i>
                                        <h5>No Users Found</h5>
                                        <p class="text-muted">Get started by creating your first user.</p>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i>Create User
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($users->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
                <div class="text-muted mt-3">
                    Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of
                    {{ $users->total() }}
                    entries
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
@endsection
