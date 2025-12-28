<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavttcProgram extends Model
{
    protected $table = 'navttc_programs';

    protected $fillable = [
        'title',
        'required_qualification',
        'apply_link',
        'status',
    ];
}
