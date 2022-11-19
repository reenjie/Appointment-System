<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clinic',
        'category',
        'doctor',
        'dateofappointment',
        'timeofappointment',
        'refferedto',
        'refferedto_doctor',
        'remarks',
        'treatment',
        'attachedfile',
        'status',
        'ad_status',

    ];
}
