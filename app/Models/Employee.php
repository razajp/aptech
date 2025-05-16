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
        'email',
        'username',
        'password',
        'designation',
        'department',
        'joining_date', 
        'salary',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function attendance() {
        return $this->hasMany(Attendance::class, 'empid');
    }
}
