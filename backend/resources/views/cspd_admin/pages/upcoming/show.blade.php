@extends('cspd_admin.layout.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="card program-details-card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0 text-white"><i class="fas fa-eye me-2 "></i>Program Details</h4>
                        <small class="opacity-75">{{ $program->title }}</small>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('admin.upcoming.edit', $program->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('admin.upcoming.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Program Header Info -->
                <div class="program-header mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h3 class="text-primary">{{ $program->title }}</h3>
                            <div class="mb-3">
                                <span class="badge {{ $program->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    <i class="fas fa-circle me-1"></i>{{ ucfirst($program->status) }}
                                </span>
                                <span class="badge bg-info ms-2">
                                    <i class="fas fa-calendar me-1"></i>{{ $program->display_date }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="card bg-light">
                                <div class="card-body py-2">
                                    <h5 class="text-warning mb-1">{{ $program->formatted_fees }}</h5>
                                    <small class="text-muted">Program Fee</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info -->
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="fas fa-clock text-primary"></i>
                                <div>
                                    <strong>Duration</strong>
                                    <p class="mb-0">{{ $program->duration }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="fas fa-hourglass-half text-info"></i>
                                <div>
                                    <strong>Total Hours</strong>
                                    <p class="mb-0">{{ $program->total_hours }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="fas fa-clock text-success"></i>
                                <div>
                                    <strong>Timing</strong>
                                    <p class="mb-0">{{ $program->timing }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <i class="fas fa-calendar-alt text-danger"></i>
                                <div>
                                    <strong>Date</strong>
                                    <p class="mb-0">{{ $program->display_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Discount Info -->
                @if ($program->discount_info)
                    <div class="alert alert-warning mb-4">
                        <h5><i class="fas fa-tag me-2"></i>Discount Information</h5>
                        <p class="mb-0">{{ $program->discount_info }}</p>
                    </div>
                @endif

                <!-- Brochure Section -->
                @if ($program->brochure)
                    <div class="alert alert-info mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"><i class="fas fa-file-pdf me-2"></i>Program Brochure</h5>
                                <small class="text-muted">PDF brochure available for download</small>
                            </div>
                            <a href="{{ asset('storage/' . $program->brochure) }}" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-download me-1"></i>View/Download Brochure
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Tabs for Details -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-overview-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-overview" type="button" role="tab">
                            <i class="fas fa-file-alt me-1"></i>Overview
                        </button>
                        <button class="nav-link" id="nav-outline-tab" data-bs-toggle="tab" data-bs-target="#nav-outline"
                            type="button" role="tab">
                            <i class="fas fa-list-ol me-1"></i>Course Outline
                        </button>
                        <button class="nav-link" id="nav-outcomes-tab" data-bs-toggle="tab" data-bs-target="#nav-outcomes"
                            type="button" role="tab">
                            <i class="fas fa-graduation-cap me-1"></i>Learning Outcomes
                        </button>
                        <button class="nav-link" id="nav-trainer-tab" data-bs-toggle="tab" data-bs-target="#nav-trainer"
                            type="button" role="tab">
                            <i class="fas fa-chalkboard-teacher me-1"></i>Trainer Profile
                        </button>
                    </div>
                </nav>

                <div class="tab-content p-3 border border-top-0 rounded-bottom" id="nav-tabContent">
                    <!-- Overview Tab -->
                    <div class="tab-pane fade show active" id="nav-overview" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                {!! nl2br(e($program->overview)) !!}
                            </div>
                        </div>

                        @if ($program->methodology)
                            <div class="mt-4">
                                <h5><i class="fas fa-tasks me-2"></i>Course Methodology</h5>
                                <div class="card">
                                    <div class="card-body">
                                        {!! nl2br(e($program->methodology)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($program->activities)
                            <div class="mt-4">
                                <h5><i class="fas fa-running me-2"></i>Activities</h5>
                                <div class="card">
                                    <div class="card-body">
                                        {!! nl2br(e($program->activities)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Course Outline Tab -->
                    <div class="tab-pane fade" id="nav-outline" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                {!! nl2br(e($program->course_outline)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Learning Outcomes Tab -->
                    <div class="tab-pane fade" id="nav-outcomes" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                {!! nl2br(e($program->learning_outcomes)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Trainer Profile Tab -->
                    <div class="tab-pane fade" id="nav-trainer" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                {!! nl2br(e($program->trainer_profile)) !!}
                            </div>
                        </div>

                        @if ($program->who_should_attend)
                            <div class="mt-4">
                                <h5><i class="fas fa-users me-2"></i>Who Should Attend</h5>
                                <div class="card">
                                    <div class="card-body">
                                        {!! nl2br(e($program->who_should_attend)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($program->publications)
                            <div class="mt-4">
                                <h5><i class="fas fa-book me-2"></i>Publications</h5>
                                <div class="card">
                                    <div class="card-body">
                                        {!! nl2br(e($program->publications)) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Program Metadata -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-info-circle me-2"></i>Program Information</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-1">
                                        <strong>ID:</strong> {{ $program->id }}
                                    </li>
                                    <li class="mb-1">
                                        <strong>Created:</strong> {{ $program->created_at->format('M d, Y h:i A') }}
                                    </li>
                                    <li class="mb-1">
                                        <strong>Last Updated:</strong> {{ $program->updated_at->format('M d, Y h:i A') }}
                                    </li>
                                    <li>
                                        <strong>Status:</strong>
                                        <span
                                            class="badge {{ $program->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($program->status) }}
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6><i class="fas fa-cog me-2"></i>Actions</h6>
                                <div class="btn-group-vertical w-100" role="group">
                                    <a href="{{ route('admin.upcoming.edit', $program->id) }}"
                                        class="btn btn-warning mb-2">
                                        <i class="fas fa-edit me-2"></i>Edit Program
                                    </a>
                                    <form action="{{ route('admin.upcoming.destroy', $program->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this program?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fas fa-trash-alt me-2"></i>Delete Program
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-activate first tab
            const firstTab = new bootstrap.Tab(document.querySelector('#nav-overview-tab'));
            firstTab.show();
        });
    </script>
@endsection
