<?php

namespace App\Models;

use App\Models\Admin\Employee\EmployeeOfficialInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'guard',
        'login_ip',
        'date_time',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id')->where('guard', 'admin');
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeOfficialInformation::class, 'user_id')->where('guard', 'employee');
    }
}
