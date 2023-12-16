<?php

namespace App\Models;

use App\Enums\BoolStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="comments";
    protected $fillable = [
        'comment',
        'parent_id',
        'name',
        'email',
        'type',
        'type_id',
        'is_show',
        'show_at',
        'is_seen',
        'admin_reply'
    ];

    public function ActiveParent() {
        return $this->belongsTo(Comment::class,"parent_id")->where("is_show",BoolStatus::yes);
    }
    public function ActiveChildren() {
        return $this->hasMany(Comment::class,"parent_id")->where("is_show",BoolStatus::yes);
    }

    public function Parent() {
        return $this->belongsTo(Comment::class,"parent_id");
    }
    public function Children() {
        return $this->hasMany(Comment::class,"parent_id");
    }
    public function AdminReply() {
        return $this->hasOne(Comment::class,"parent_id")->where("admin_reply",BoolStatus::yes);
    }
    public function Project() {
        return $this->belongsTo(Project::class,"type_id");
    }
    public function Weblog() {
        return $this->belongsTo(Weblog::class,"type_id");
    }
}
