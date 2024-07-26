<?php

namespace App\Models;

use App\Enums\Status;
use DOMDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Shetabit\Visitor\Traits\Visitable;

class Post extends Model implements HasMedia
{
    use HasSlug, HasTags, Visitable, HasSEO, HasFactory, InteractsWithMedia;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('large')
            ->width(1284)
            ->height(600)
            ->sharpen(10)
            ->nonQueued();

        $this
            ->addMediaConversion('medium')
            ->width(954)
            ->height(450)
            ->sharpen(10)
            ->nonQueued();

        $this
            ->addMediaConversion('small')
            ->width(624)
            ->height(300)
            ->sharpen(10)
            ->nonQueued();

        $this
            ->addMediaConversion('single')
            ->width(1944)
            ->height(900)
            ->sharpen(10)
            ->nonQueued();
    }

    public function getSingleImageAttribute()
    {
        $mediaItems = $this->getMedia();

        return count($mediaItems)  > 0 ? $mediaItems[0]->getUrl('single') : 'https://via.assets.so/img.jpg?w=1944&h=900&tc=blue&bg=#cecece';
    }

    public function getLargeImageAttribute()
    {
        $mediaItems = $this->getMedia();

        return count($mediaItems)  > 0 ? $mediaItems[0]->getUrl('large') : 'https://via.assets.so/img.jpg?w=1284&h=600&tc=blue&bg=#cecece';
    }

    public function getMediumImageAttribute()
    {
        $mediaItems = $this->getMedia();

        return count($mediaItems)  > 0 ? $mediaItems[0]->getUrl('medium') : 'https://via.assets.so/img.jpg?w=954&h=450&tc=blue&bg=#cecece';
    }

    public function getSmallImageAttribute()
    {
        $mediaItems = $this->getMedia();

        return count($mediaItems)  > 0 ? $mediaItems[0]->getUrl('small') : 'https://via.assets.so/img.jpg?w=624&h=300&tc=blue&bg=#cecece';
    }

    public function getDateAttribute()
    {
        return $this->created_at->format(config('listing.date_format'));
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

    public function scopePublished($query)
    {
        return $query->where('status', Status::PUBLISHED);
    }


    public function contentRender()
    {
        $dom = new DOMDocument();
        // Carga el contenido HTML
        libxml_use_internal_errors(true); // Para evitar warnings con HTML malformado
        $dom->loadHTML($this->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Obtiene todas las etiquetas <p>
        $paragraphs = $dom->getElementsByTagName('p');

        // Agrega las clases a cada etiqueta <p>
        foreach ($paragraphs as $paragraph) {
            $existingClass = $paragraph->getAttribute('class');
            $newClass = 'text-light opacity-70 mb-1';
            $paragraph->setAttribute('class', trim("$existingClass $newClass"));
        }

        // Guarda el contenido HTML modificado
        return $dom->saveHTML();
    }
}
