<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceClient extends Model
{
    use HasFactory;
    protected $fillable = ['service_id', 'client_id','status'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
