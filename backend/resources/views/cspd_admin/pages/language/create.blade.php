@extends('cspd_admin.layout.app')

@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="form-container">
            <div class="form-header">
                <h2><i class="fas fa-language me-2"></i>Add Language Course</h2>
                <p class="text-muted mb-0">Fill in the details for the new language course</p>
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

            <form method="POST" action="{{ route('admin.language.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-heading me-1"></i> Course Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                            @error('title') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-calendar me-1"></i> Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}"
                                class="form-control @error('start_date') is-invalid @enderror">
                            @error('start_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-calendar me-1"></i> End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}"
                                class="form-control @error('end_date') is-invalid @enderror">
                            @error('end_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="fas fa-clock me-1"></i> Duration</label>
                                    <input type="text" name="duration" value="{{ old('duration') }}"
                                        class="form-control @error('duration') is-invalid @enderror" placeholder="e.g., 3 Months">
                                    @error('duration') <span class="error-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"><i class="fas fa-clock me-1"></i> Total Hours</label>
                                    <input type="text" name="total_hours" value="{{ old('total_hours') }}"
                                        class="form-control @error('total_hours') is-invalid @enderror" placeholder="e.g., 100 Hours">
                                    @error('total_hours') <span class="error-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-clock me-1"></i> Timing</label>
                            <input type="text" name="timing" value="{{ old('timing') }}"
                                class="form-control @error('timing') is-invalid @enderror" placeholder="e.g., 9:00 am to 1:00 pm">
                            @error('timing') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-money-bill-wave me-1"></i> Course Fees (PKR)</label>
                            <input type="number" name="fees" step="0.01" value="{{ old('fees') }}"
                                class="form-control @error('fees') is-invalid @enderror" placeholder="e.g., 25000">
                            @error('fees') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-toggle-on me-1"></i> Status *</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-link me-1"></i> Enroll Link</label>
                            <input type="url" name="enroll_link" value="{{ old('enroll_link') }}"
                                class="form-control @error('enroll_link') is-invalid @enderror" placeholder="Enter enrollment URL">
                            @error('enroll_link') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-image me-1"></i> Trainer Image</label>
                            <input type="file" name="trainer_image" accept="image/*"
                                class="form-control @error('trainer_image') is-invalid @enderror">
                            <small class="text-muted">Upload trainer's photo (Optional, Max 2MB)</small>
                            @error('trainer_image') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-file-alt me-1"></i> Course Overview</label>
                            <textarea name="overview" rows="4" class="form-control @error('overview') is-invalid @enderror"
                                placeholder="Enter course overview...">{{ old('overview') }}</textarea>
                            @error('overview') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-list-ol me-1"></i> Course Outline</label>
                            <textarea name="course_outline" rows="6" class="form-control @error('course_outline') is-invalid @enderror"
                                placeholder="Enter course outline...">{{ old('course_outline') }}</textarea>
                            @error('course_outline') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-graduation-cap me-1"></i> Learning Outcomes</label>
                            <textarea name="learning_outcomes" rows="4"
                                class="form-control @error('learning_outcomes') is-invalid @enderror"
                                placeholder="What will participants learn?...">{{ old('learning_outcomes') }}</textarea>
                            @error('learning_outcomes') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="fas fa-chalkboard-teacher me-1"></i> Trainer Profile</label>
                            <textarea name="trainer_profile" rows="4" class="form-control @error('trainer_profile') is-invalid @enderror"
                                placeholder="Enter trainer's profile...">{{ old('trainer_profile') }}</textarea>
                            @error('trainer_profile') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                        <div class="form-group">
                            <label class="form-label">Online Form Availability Date</label>
                            <input type="date" name="online_form_availability_date" value="{{ old('online_form_availability_date') }}"
                                class="form-control @error('online_form_availability_date') is-invalid @enderror">
                            @error('online_form_availability_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Form Submission Deadline</label>
                            <input type="date" name="form_submission_deadline" value="{{ old('form_submission_deadline') }}"
                                class="form-control @error('form_submission_deadline') is-invalid @enderror">
                            @error('form_submission_deadline') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Enrollment Offers Date</label>
                            <input type="date" name="enrollment_offers_date" value="{{ old('enrollment_offers_date') }}"
                                class="form-control @error('enrollment_offers_date') is-invalid @enderror">
                            @error('enrollment_offers_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Fee and Document Submission Date</label>
                            <input type="date" name="fee_document_submission_date" value="{{ old('fee_document_submission_date') }}"
                                class="form-control @error('fee_document_submission_date') is-invalid @enderror">
                            @error('fee_document_submission_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Orientation Ceremony Date</label>
                            <input type="date" name="orientation_ceremony_date" value="{{ old('orientation_ceremony_date') }}"
                                class="form-control @error('orientation_ceremony_date') is-invalid @enderror">
                            @error('orientation_ceremony_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Class Commencement Date</label>
                            <input type="date" name="class_commencement_date" value="{{ old('class_commencement_date') }}"
                                class="form-control @error('class_commencement_date') is-invalid @enderror">
                            @error('class_commencement_date') <span class="error-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="btn-form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Course
                    </button>
                    <a href="{{ route('admin.language.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
