@extends('cspd_admin.layout.app')

@section('content')

<div class="container-fluid pt-4 px-4 ">

<div class="table-header">
            <div>
                <h2><i class="fas fa-list-alt me-2"></i>Add Calendar PDF</h2>
            </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.calendars.store') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Calendar Title</label>
        <input type="text"
               name="title"
               class="form-control"
               value="{{ old('title') }}"
               required>
    </div>

    <div class="mb-3">
        <label>Upload Calendar (PDF)</label>
        <input type="file"
               name="calendar_pdf"
               class="form-control"
               accept="application/pdf"
               required>
    </div>

    <button type="submit" class="btn btn-primary">
        Upload Calendar
    </button>

    <a href="{{ route('admin.calendars.index') }}"
       class="btn btn-secondary">
        Back
    </a>

</form>

</div>

@endsection
