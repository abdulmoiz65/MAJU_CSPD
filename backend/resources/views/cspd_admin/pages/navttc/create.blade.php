@extends('cspd_admin.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4 ">
<div class="table-header">
            <div>
                <h2><i class="fas fa-list-alt me-2"></i>ADD NAVTTC Programs</h2>
                {{-- <p class="text-muted mb-0">Manage all NAVTTC programs</p> --}}
            </div>
            <a href="{{ route('admin.navttc.index') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-2"></i>View Navttc Program
            </a>
        </div>
{{-- Global Error Alert --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.navttc.store') }}">
    @csrf

    {{-- Program Title --}}
    <div class="mb-3">
        <label>Program Title</label>
        <input 
            type="text" 
            name="title"
            value="{{ old('title') }}"
            class="form-control @error('title') is-invalid @enderror"
        >

        @error('title')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Required Qualification --}}
    <div class="mb-3">
        <label>Required Qualification</label>
        <textarea 
            name="required_qualification"
            class="form-control @error('required_qualification') is-invalid @enderror"
        >{{ old('required_qualification') }}</textarea>

        @error('required_qualification')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Apply Link --}}
    <div class="mb-3">
        <label>Apply Link</label>
        <input 
            type="url" 
            name="apply_link"
            value="{{ old('apply_link', 'https://nsis.navttc.gov.pk/') }}"
            class="form-control @error('apply_link') is-invalid @enderror"
        >

        @error('apply_link')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- Status --}}
    <div class="mb-3">
        <label>Status</label>
        <select 
            name="status"
            class="form-control @error('status') is-invalid @enderror"
        >
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                Active
            </option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                Inactive
            </option>
        </select>

        @error('status')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">
        Save Program
    </button>
</form>
</div>
@endsection
