@extends('cspd_admin.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="table-header">
        <div>
            <h2><i class="fas fa-list-alt me-2"></i>Calendar PDFs</h2>
        </div>
        <a href="{{ route('admin.calendars.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Add New Calendar
        </a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>PDF</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($calendars as $calendar)
                    <tr>
                        <td>{{ ($calendars->currentPage() - 1) * $calendars->perPage() + $loop->iteration }}</td>
                        <td>{{ $calendar->title }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $calendar->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View PDF
                            </a>
                        </td>
                        <td>{{ $calendar->created_at->format('d M Y') }}</td>
                        <td>
                            <form action="{{ route('admin.calendars.destroy', $calendar->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this calendar permanently?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash me-1"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            No calendars uploaded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($calendars->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    <li class="page-item {{ $calendars->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $calendars->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    {{-- Page Numbers --}}
                    @for ($i = 1; $i <= $calendars->lastPage(); $i++)
                        <li class="page-item {{ $calendars->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $calendars->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next Page Link --}}
                    <li class="page-item {{ !$calendars->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $calendars->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    @endif
</div>

@endsection