<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Shetabit\Visitor\Traits\Visitable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class MakeModel extends Model
{
    use HasSlug, HasFactory, Visitable;

    protected $fillable = [
        'name',
        'slug',
        'description',
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

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class, 'makemodel_id', 'id');
    }
}
