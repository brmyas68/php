<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table="galleries";
    protected $fillable = [
        'image',
        'project_id'
    ];
    public function Project(){
        return $this->belongsTo(Project::class);
    }
}
