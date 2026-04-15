<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCounter extends Model
{
    use HasFactory;
    protected $fillable = [
        'counter_title',
        'data_count',
        'counter_symbol',
        'counter_icon',
        'status',
    ];
}
