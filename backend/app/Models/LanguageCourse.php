<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageCourse extends Model
{
    protected $fillable = [
        'title',
        'overview',
        'course_outline',
        'learning_outcomes',
        'trainer_profile',
        'trainer_image',
        'enroll_link',
        'start_date',
        'end_date',
        'duration',
        'total_hours',
        'timing',
        'fees',
        'currency',
        'status',
        'registration_date',
        'online_form_availability_date',
        'form_submission_deadline',
        'enrollment_offers_date',
        'fee_document_submission_date',
        'orientation_ceremony_date',
        'class_commencement_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'fees' => 'decimal:2',
        'registration_date' => 'date',
        'online_form_availability_date' => 'date',
        'form_submission_deadline' => 'date',
        'enrollment_offers_date' => 'date',
        'fee_document_submission_date' => 'date',
        'orientation_ceremony_date' => 'date',
        'class_commencement_date' => 'date',
    ];

    protected $appends = [
        'formatted_date',
        'display_date',
        'formatted_fees',
    ];

    public function getFormattedDateAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = $this->start_date;
            $end = $this->end_date;

            if ($start->year != $end->year) {
                return $start->format('F d, Y') . ' - ' . $end->format('F d, Y');
            } elseif ($start->month != $end->month) {
                return $start->format('F d') . ' - ' . $end->format('F d, Y');
            } else {
                return $start->format('F d') . ' - ' . $end->format('d, Y');
            }
        } elseif ($this->start_date) {
            return $this->start_date->format('F d, Y');
        }
        return null;
    }

    public function getDisplayDateAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->format('F d, Y');
        }
        return null;
    }

    public function getFormattedFeesAttribute()
    {
        if ($this->fees) {
            return 'PKR ' . number_format($this->fees, 0) . ' /-';
        }
        return 'Free';
    }

}

