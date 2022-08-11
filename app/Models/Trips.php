<?php

namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trips extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * @var string[]
     */
    protected $fillable =
        [
            'title',
            'slug',
            'description',
            'start_date',
            'end_date',
            'location',
            'price'
        ];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function user() {
        return $this->hasOneThrough(User::class,Bookings::class,'user_id','id','id');
    }

}
