<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_city',
        'company_country',
        'company_facebook',
        'company_twitter',
        'company_linkedin',
        'company_instagram',
        'company_industry',
        'company_founded_in',
        'company_size',
        'company_cover_image',
        'company_logo_image',
        'company_description',
        'company_website'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
