<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
       'name',
        'member_code',
        'department',
        'designation',
        'dob',
        'joining_date',
        'gender',
        'blood_group',
        'phone',
        'email',
        'whatsapp',
        'facebook',
        'linkedin',
        'github',
        'address',
        'about',
        'image',
        'status',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/members/' . $this->image) : asset('frontend/assets/images/member-1.jpg');
    }

}
