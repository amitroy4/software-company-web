<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferedService extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'offered_service',
        'service_image',
        'status',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
