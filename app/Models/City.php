<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table="cities";
    protected $fillable = [
        "name",
        "slug",
        "province_id"
    ];

    public function Projects(){
        return $this->hasMany(Project::class);
    }
}
