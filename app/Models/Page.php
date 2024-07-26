<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Shetabit\Visitor\Traits\Visitable;

class Page extends Model
{
    use HasSlug, HasSEO, Visitable, HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => \App\Enums\Status::class
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sections()
    {
        return $this->belongsToMany(FrontSection::class)->withPivot('sort_order')->orderBy('sort_order');
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
}
