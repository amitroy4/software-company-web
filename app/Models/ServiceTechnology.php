<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTechnology extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'technology_name',
        'technology_image',
        'status',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
