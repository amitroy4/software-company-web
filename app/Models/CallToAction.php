<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallToAction extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sub_title',
        'button_text',
        'button_url',
        'main_icon',
        'call_button_text',
        'call_button_url',
        'contact_no',
        'call_button_icon',
        'status',
    ];
}
