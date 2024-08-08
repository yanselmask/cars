<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Overtrue\LaravelFollow\Traits\Followable;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Make extends Model
{
    use HasSlug, HasFactory, Visitable, Followable;

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

    public function makemodels()
    {
        return $this->hasMany(MakeModel::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->icon ? Storage::url($this->icon) : 'https://via.assets.so/img.jpg?w=400&h=400&tc=#fff&bg=#000';
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
