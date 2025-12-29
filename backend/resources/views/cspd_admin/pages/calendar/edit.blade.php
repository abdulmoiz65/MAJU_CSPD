@extends('cspd_admin.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="table-header">
        <div>
            <h2>
                <i class="fas fa-edit me-2"></i>
                Edit Calendar PDF
            </h2>
        </div>
    </div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.calendars.update', $calendar->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label>Calendar Title</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $calendar->title) }}"
                   required>
        </div>

        {{-- Current PDF --}}
        <div class="mb-3">
            <label>Current PDF</label><br>
            <a href="{{ asset('storage/' . $calendar->file_path) }}"
               target="_blank"
               class="btn btn-sm btn-outline-primary">
                <i class="fas fa-eye me-1"></i> View Current PDF
            </a>
        </div>

        {{-- Replace PDF --}}
        <div class="mb-3">
            <label>Replace PDF (Optional)</label>
            <input type="file"
                   name="calendar_pdf"
                   class="form-control"
                   accept="application/pdf">
            <small class="text-muted">
                Leave empty if you don’t want to change the PDF
            </small>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="inactive"
                    {{ old('status', $calendar->status) === 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
                <option value="active"
                    {{ old('status', $calendar->status) === 'active' ? 'selected' : '' }}>
                    Active
                </option>
            </select>
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Update Calendar
        </button>

        <a href="{{ route('admin.calendars.index') }}"
           class="btn btn-secondary">
            Back
        </a>

    </form>

</div>

@endsection
