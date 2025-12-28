@extends('cspd_admin.layout.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="form-container">
        <div class="form-header">
            <h2><i class="fas fa-calendar-plus me-2"></i>Add Upcoming Program</h2>
            <p class="text-muted mb-0">Fill in the details for the new upcoming program</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong><i class="fas fa-exclamation-circle me-2"></i>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.upcoming.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Title -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-heading me-1"></i> Program Title *
                        </label>
                        <input type="text" name="title" 
                               value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="e.g., Personality Development and Work Ethics" required>
                        @error('title')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date Information -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar me-1"></i> Start Date *
                        </label>
                        <input type="date" name="start_date" 
                               value="{{ old('start_date') }}"
                               class="form-control @error('start_date') is-invalid @enderror" required>
                        @error('start_date')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar me-1"></i> End Date (Optional)
                        </label>
                        <input type="date" name="end_date" 
                               value="{{ old('end_date') }}"
                               class="form-control @error('end_date') is-invalid @enderror">
                        @error('end_date')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Duration & Timing -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i> Duration *
                                </label>
                                <input type="text" name="duration" 
                                       value="{{ old('duration') }}"
                                       class="form-control @error('duration') is-invalid @enderror"
                                       placeholder="e.g., 1 Day" required>
                                @error('duration')
                                    <span class="error-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-clock me-1"></i> Total Hours *
                                </label>
                                <input type="text" name="total_hours" 
                                       value="{{ old('total_hours') }}"
                                       class="form-control @error('total_hours') is-invalid @enderror"
                                       placeholder="e.g., 8 Hours" required>
                                @error('total_hours')
                                    <span class="error-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Timing -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-clock me-1"></i> Timing *
                        </label>
                        <input type="text" name="timing" 
                               value="{{ old('timing') }}"
                               class="form-control @error('timing') is-invalid @enderror"
                               placeholder="e.g., 9:00 am to 5:00 pm" required>
                        @error('timing')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Fees -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-money-bill-wave me-1"></i> Program Fees (PKR) *
                        </label>
                        <input type="number" name="fees" step="0.01"
                               value="{{ old('fees') }}"
                               class="form-control @error('fees') is-invalid @enderror"
                               placeholder="e.g., 12000" required>
                        @error('fees')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Discount Info -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tag me-1"></i> Discount Information
                        </label>
                        <textarea name="discount_info" rows="3"
                                  class="form-control @error('discount_info') is-invalid @enderror"
                                  placeholder="e.g., 10% early bird discount before November 30, 2025">{{ old('discount_info') }}</textarea>
                        @error('discount_info')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-toggle-on me-1"></i> Status *
                        </label>
                        <select name="status" 
                                class="form-control @error('status') is-invalid @enderror" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                        @error('status')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Text Areas (Full Width) -->
            <div class="row">
                <div class="col-12">
                    <!-- Overview -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-file-alt me-1"></i> Course Overview *
                        </label>
                        <textarea name="overview" rows="4"
                                  class="form-control @error('overview') is-invalid @enderror"
                                  placeholder="Enter course overview..." required>{{ old('overview') }}</textarea>
                        @error('overview')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Course Outline -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-list-ol me-1"></i> Course Outline *
                        </label>
                        <textarea name="course_outline" rows="6"
                                  class="form-control @error('course_outline') is-invalid @enderror"
                                  placeholder="Enter course outline (one per line or in paragraphs)..." required>{{ old('course_outline') }}</textarea>
                        <small class="text-muted">You can use bullet points or numbered lists</small>
                        @error('course_outline')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Learning Outcomes -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-graduation-cap me-1"></i> Learning Outcomes *
                        </label>
                        <textarea name="learning_outcomes" rows="4"
                                  class="form-control @error('learning_outcomes') is-invalid @enderror"
                                  placeholder="What will participants learn?..." required>{{ old('learning_outcomes') }}</textarea>
                        @error('learning_outcomes')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Trainer Profile -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-chalkboard-teacher me-1"></i> Trainer Profile *
                        </label>
                        <textarea name="trainer_profile" rows="4"
                                  class="form-control @error('trainer_profile') is-invalid @enderror"
                                  placeholder="Enter trainer's profile and qualifications..." required>{{ old('trainer_profile') }}</textarea>
                        @error('trainer_profile')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Methodology (Optional) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tasks me-1"></i> Course Methodology
                        </label>
                        <textarea name="methodology" rows="3"
                                  class="form-control @error('methodology') is-invalid @enderror"
                                  placeholder="How will the course be delivered?...">{{ old('methodology') }}</textarea>
                        @error('methodology')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Activities (Optional) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-running me-1"></i> Activities
                        </label>
                        <textarea name="activities" rows="3"
                                  class="form-control @error('activities') is-invalid @enderror"
                                  placeholder="What activities will be included?...">{{ old('activities') }}</textarea>
                        @error('activities')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Who Should Attend (Optional) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-users me-1"></i> Who Should Attend
                        </label>
                        <textarea name="who_should_attend" rows="3"
                                  class="form-control @error('who_should_attend') is-invalid @enderror"
                                  placeholder="Who is this program for?...">{{ old('who_should_attend') }}</textarea>
                        @error('who_should_attend')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Publications (Optional) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-book me-1"></i> Publications
                        </label>
                        <textarea name="publications" rows="3"
                                  class="form-control @error('publications') is-invalid @enderror"
                                  placeholder="List any publications...">{{ old('publications') }}</textarea>
                        @error('publications')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Brochure Upload (Optional) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-file-pdf me-1"></i> Program Brochure (PDF)
                        </label>
                        <input type="file" name="brochure" 
                               accept=".pdf"
                               class="form-control @error('brochure') is-invalid @enderror">
                        <small class="text-muted">Upload a PDF brochure (Optional, Max 5MB)</small>
                        @error('brochure')
                            <span class="error-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Program
                </button>
                <a href="{{ route('admin.upcoming.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection