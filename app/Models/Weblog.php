<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Weblog extends Model
{
    use HasFactory;
    use HasSlug;
    protected $table="weblogs";
    protected $fillable = [
        'image',
        'subject',
        'user_id',
        'service_id',
        'category_id',
        'views',
        'description'
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

    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function Service(){
        return $this->belongsTo(Service::class);
    }
    public function Tags(){
        return $this->belongsToMany(Tag::class);
    }
    public function Comments(){
        return $this->hasMany(Comment::class,"type_id");
    }
}
