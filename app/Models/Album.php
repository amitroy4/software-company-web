<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover_image',
        'status',
    ];

    public function albumImageVideos()
    {
        return $this->hasMany(AlbumImageVideo::class);
    }
}
