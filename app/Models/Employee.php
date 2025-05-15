<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'empid',
        'name',
        'password',
    ];

    public function attendance() {
        return $this->hasMany(Attendance::class, 'empid');
    }
}
