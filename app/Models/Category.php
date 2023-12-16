<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $fillable = [
        'name',
        'level',
        'parent_id'
    ];

    public function Parent()
    {
        return $this->belongsTo(Category::class,"parent_id");
    }
    public function Children()
    {
        return $this->hasMany(Category::class,"parent_id");
    }
}
