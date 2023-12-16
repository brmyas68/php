<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table="provinces";
    protected $fillable = [
        "name",
        "slug"
    ];

    public function Projects(){
        return $this->hasMany(Project::class);
    }
}
