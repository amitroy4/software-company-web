<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_name',
        'slug',
        'image',
        'service_details',
        'counter_title',
        'counter_icon',
        'data_count',
        'counter_symbol',
        'contact_title',
        'contact_url',
        'button_text',
        'status',
    ];
    public function whyNeeds()
    {
        return $this->hasMany(ServiceNeed::class);
    }
    public function offeredService()
    {
        return $this->hasMany(OfferedService::class);
    }
    public function clients()
    {
        return $this->hasMany(ServiceClient::class);
    }

    public function developmentProcess()
    {
        return $this->hasMany(ServiceDevelopment::class);
    }


    public function technologies()
    {
        return $this->hasMany(ServiceTechnology::class);
    }
    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class);
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}
