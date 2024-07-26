<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class OfferType extends Model
{
    use HasSlug, HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'display_as_label',
        'card_label_text_color',
        'card_label_background_color'
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
}
