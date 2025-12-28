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
        'status'
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'fees' => 'decimal:2'
    ];
    
    // Accessor for formatted date
    public function getFormattedDateAttribute()
    {
        if ($this->start_date && $this->end_date) {
            return $this->start_date->format('F d') . ' - ' . $this->end_date->format('d, Y');
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
}
