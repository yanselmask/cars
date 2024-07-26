<?php

namespace App\Models;

use App\Enums\FeatureType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Feature extends Model
{
    use HasSlug, HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'type'
    ];

    protected $casts = [
        'type' => FeatureType::class
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class);
    }
}
