<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table="companies";
    protected $fillable = [
        'name',
        'logo',
        'film',
        'email',
        'phone',
        'mobile',
        'slogan',
        'start_year',
        'location',
        'address',
        'description',
        'saturday_to_wednesday',
        'thursday'
    ];
}
