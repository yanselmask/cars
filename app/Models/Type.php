<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Type extends Model
{
    use HasSlug, HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon'
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
        return $this->hasMany(Listing::class);
    }

    public function getIconUrlAttribute()
    {
        return $this->icon ? Storage::url($this->icon) : 'https://finder.createx.studio/img/car-finder/icons/suv.svg';
    }
}
