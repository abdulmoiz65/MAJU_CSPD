@extends('cspd_admin.layout.app')

@section('content')
    <div class="container pt-4 px-4 ">
        <div class="table-header">
            <div>
                <h2><i class="fas fa-list-alt me-2"></i>NAVTTC Programs</h2>
                <p class="text-muted mb-0">Manage all NAVTTC programs</p>
            </div>
            <a href="{{ route('admin.navttc.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>Add New Program
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif



        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Qualification</th>
                    <th>Apply Link</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ Str::limit($program->title, 25) }}</td>
                        <td>{{ Str::limit($program->required_qualification, 25) }}</td>
                        <td>
                            @if ($program->apply_link)
                                <a href="{{ $program->apply_link }}" target="_blank">
                                    {{ Str::limit($program->apply_link, 30) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $program->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($program->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.navttc.edit', $program->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('admin.navttc.destroy', $program->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to delete this program?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Simple Pagination --}}
        @if ($programs->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
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

    </div>
@endsection
