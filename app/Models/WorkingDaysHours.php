<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDaysHours extends Model
{
    use HasFactory;
    protected $table="working_days_hours";
    protected $fillable = [
        'day',
        'start_work',
        'end_work',
        'status'
    ];
}
