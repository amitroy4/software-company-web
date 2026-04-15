<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sub_title',
        'quote',
        'description',
        'year_of_experience',
        'image',
        'status',
    ];
    public function keypoints()
    {
        return $this->hasMany(AboutKeypoint::class);
    }
}
