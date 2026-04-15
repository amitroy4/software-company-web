<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_category_id',
        'title',
        'blog_url',
        'slug',
        'description',
        'image',
        'date',
        'author',
        'tags',
        'status',
    ];
    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function getImageAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

}
