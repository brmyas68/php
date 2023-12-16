<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasFactory;
    use HasSlug;
    protected $table="projects";
    protected $fillable = [
        'image',
        'mobile_image',
        'video',
        'subject',
        'client_id',
        'service_id',
        'type',
        'started_at',
        'finished_at',
        'location',
        'province_id',
        'city_id',
        'is_contractor',
        'contractor_id',
        'contract_duration',
        'summery',
        'description',
        'show_in_slider'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('subject')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(40)
            ->usingSeparator('-');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function Tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function Galleries(){
        return $this->hasMany(Gallery::class);
    }
    public function Service(){
        return $this->belongsTo(Service::class);
    }
    public function Client(){
        return $this->belongsTo(Client::class);
    }
    public function Contractor(){
        return $this->belongsTo(Contractor::class);
    }
    public function Comments(){
        return $this->hasMany(Comment::class,"type_id");
    }
    public function City(){
        return $this->belongsTo(City::class);
    }
    public function Province(){
        return $this->belongsTo(Province::class);
    }
}
