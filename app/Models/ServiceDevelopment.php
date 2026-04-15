<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDevelopment extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'process_title',
        'process_details',
        'status',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
