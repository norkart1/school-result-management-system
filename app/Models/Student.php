<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'roll_number',
        'name',
        'school_code',
        'category_code',
        'subjects',
        'total_marks',
        'grade'
    ];

    // If the subjects field is JSON, automatically cast it to an array
    protected $casts = [
        'subjects' => 'array',  // Automatically decode JSON to array
    ];
}
