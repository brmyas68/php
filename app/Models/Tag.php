<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table="tags";
    protected $fillable = [
        "name"
    ];

    public function Weblogs(){
        return $this->belongsToMany(Weblog::class);
    }
    public function Projects(){
        return $this->belongsToMany(Project::class);
    }
}
