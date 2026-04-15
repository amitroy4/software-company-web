<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'vacancy',
        'location',
        'publish_date',
        'deadline',
        'image',
        'logo',
        'company_name',
        'email',
        'phone',
        'responsibilities',
        'requirements',
        'status',
        
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

}
