<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceNeed extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'keypoint_title',
        'keypoint_details',
        'status',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
