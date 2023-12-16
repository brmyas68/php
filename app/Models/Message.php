<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="messages";
    protected $fillable = [
        'name',
        'email',
        'is_seen',
        'reply_id',
        'subject',
        'description'
    ];

    public function Parent() {
        return $this->belongsTo(Message::class,"reply_id")->withTrashed();
    }
    public function Child() {
        return $this->hasOne(Message::class,"reply_id")->withTrashed();
    }
}
