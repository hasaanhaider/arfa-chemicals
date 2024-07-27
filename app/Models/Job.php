<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
            'location',
            'category',
            'description',
            'experience',
            'salary_range',
            'career_level',
            'employment_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
