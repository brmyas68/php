<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table="sliders";
    protected $fillable = [
        'file',
        'mobile_file',
        'type',
        'mobile_file_type',
        'title',
        'link',
        'order',
        'project_id',
        'is_active'
    ];

    public function Project(){
        return $this->belongsTo(Project::class);
    }
}
