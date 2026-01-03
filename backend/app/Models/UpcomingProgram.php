<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UpcomingProgram extends Model
{
    protected $fillable = [
        'title',
        'overview',
        'course_outline',
        'learning_outcomes',
        'methodology',
        'activities',
        'trainer_profile',
        'trainer_image',
        'enroll_link',
        'who_should_attend',
        'publications',
        'start_date',
        'end_date',
        'duration',
        'total_hours',
        'timing',
        'fees',
        'currency',
        'discount_info',
        'brochure',
        'status',
        // 'completed' added to fillable
        'completed'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'fees' => 'decimal:2',
        'completed' => 'boolean'
    ];

    // Append accessors to JSON output
    // appends moved to bottom to include is_completed
    /*
    protected $appends = [
        'formatted_date',
        'display_date',
        'formatted_fees',
        'date_duration'
    ];
    */

    // Accessor for formatted date
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

    // Accessor for display date (like "December 11, 2025")
    public function getDisplayDateAttribute()
    {
        if ($this->start_date) {
            return $this->start_date->format('F d, Y');
        }
        return null;
    }

    // Accessor for formatted fees
    public function getFormattedFeesAttribute()
    {
        if ($this->fees) {
            return 'PKR ' . number_format($this->fees, 0) . ' /-';
        }
        return 'Free';
    }

    // Accessor for date and duration summary
    public function getDateDurationAttribute()
    {
        $parts = [];
        if ($this->display_date) {
            $parts[] = $this->display_date;
        }
        if ($this->duration) {
            $parts[] = $this->duration;
        }
        if ($this->total_hours) {
            $parts[] = $this->total_hours;
        }

        return implode(' | ', $parts);
    }

    // Accessor for completed status
    public function getIsCompletedAttribute()
    {
        if ($this->completed) {
            return true;
        }

        if ($this->end_date && $this->end_date->isPast()) {
            return true;
        }

        return false;
    }

    protected $appends = [
        'formatted_date',
        'display_date',
        'formatted_fees',
        'date_duration',
        'is_completed'
    ];
}
