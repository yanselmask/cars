<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Group extends Model
{
    use HasSlug, HasFactory;

    protected $fillable = ['name','slug','description', 'icon','status'];

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

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', \App\Enums\Status::PUBLISHED);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', \App\Enums\Status::PENDING);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', \App\Enums\Status::DRAFT);
    }
}
