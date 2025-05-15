<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'empid',
        'state',
        'timestamp',
        'type',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class, 'empid');
    }
}
