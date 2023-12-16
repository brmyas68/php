<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="resumes";
    protected $fillable = [
        'name',
        'last_name',
        'birthday',
        'sex',
        'mobile',
        'email',
        'last_job_title',
        'organization_name',
        'activity_in_organization',
        'start_date',
        'finish_date',
        'still_work',
        'description',
        'resume',
        'is_seen',
        'status',
        'confirmed_in',
        'rejected_in'
    ];
}
