<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="media";
    protected $fillable = [
        "model_name",
        "model_id",
        "user_id",
        "file_name",
        "file_size",
        "file_path",
        "mime_type"
    ];
}
