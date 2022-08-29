<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'contact',
        'license',
        'street',
        'barangay',
        'city',
        'clinic',
        'category',
        'isavailable',
        
    ];
}
