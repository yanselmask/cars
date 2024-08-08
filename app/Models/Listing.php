<?php

namespace App\Models;

use App\Observers\ListingObserver;
use DOMDocument;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Shetabit\Visitor\Traits\Visitable;

#[ObservedBy([ListingObserver::class])]
class Listing extends Model implements HasMedia
{
    use HasSlug, Visitable, HasFactory, HasSEO, InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'location' => 'json',
        'status' => \App\Enums\ListingStatus::class,
    ];

    protected  $appends = [
        'zip',
        'full_address',
        'lat',
        'lng',
    ];

    public function getFullAddressAttribute(): ?string
    {
        if (is_array($this->location))
        {
                return app('geocoder')->reverse($this->lat,$this->lng)?->get()[0]?->getFormattedAddress();
        }

        return null;
    }

    public function getZipAttribute(): ?string
    {
        if (is_array($this->location))
        {
            return app('geocoder')->reverse($this->lat,$this->lng)?->get()[0]?->getPostalCode();
        }

        return null;
    }

    public function getCityZipAttribute()
    {
        if ($this->city && $this->zip) {
            return $this->city . ', ' . $this->zip;
        }

        return null;
    }

    public function getLatAttribute(): ?string
    {
        if (is_array($this->location))
        {
            return $this->location['lat'];
        }

        return null;
    }

    public function getLngAttribute(): ?string
    {
        if (is_array($this->location))
        {
            return $this->location['lng'];
        }

        return null;
    }

    public function getPrimaryImageAttribute()
    {
        return $this->media->count() ? $this->media[0]?->getUrl('default') : 'https://placehold.co/942x482';
    }

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

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('default')
            ->pixelate(2)
            ->fit(Fit::Crop, 942, 482)
            ->format('webp')
            ->nonQueued();

        $this
            ->addMediaConversion('thumb')
            ->pixelate(4)
            ->fit(Fit::Crop, 204, 150)
            ->format('webp')
            ->nonQueued();

        $this
            ->addMediaConversion('small')
            ->pixelate(3)
            ->fit(Fit::Crop, 760, 478)
            ->format('webp')
            ->nonQueued();

        $this
            ->addMediaConversion('featured')
            ->pixelate(2)
            ->fit(Fit::Crop, 1268, 526)
            ->format('webp')
            ->nonQueued();

        $this
            ->addMediaConversion('single')
            ->fit(Fit::Crop, 1120, 630)
            ->format('webp')
            ->nonQueued();
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }


    public function listedby()
    {
        return $this->belongsTo(ListedBy::class);
    }

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function makemodel()
    {
        return $this->belongsTo(MakeModel::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function fueltype()
    {
        return $this->belongsTo(FuelType::class);
    }

    public function engine()
    {
        return $this->belongsTo(Engine::class);
    }

    public function transmission()
    {
        return $this->belongsTo(Transmission::class);
    }

    public function drivetype()
    {
        return $this->belongsTo(DriveType::class);
    }

    public function exteriorcolor()
    {
        return $this->belongsTo(Color::class, 'exterior_color_id', 'id');
    }

    public function interiorcolor()
    {
        return $this->belongsTo(Color::class, 'interior_color_id', 'id');
    }

    public function offertype()
    {
        return $this->belongsTo(OfferType::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getPricingAttribute()
    {
        return currency_format($this->price, $this->currency->code ?? config('currency.default'));
    }

    public function getMilesAttribute()
    {
        return \Number::abbreviate($this->mileage ?? 0) . ' ' . \App\Enums\MileageType::getLabel($this->mileage_type);
    }

    public function getEngineLabelAttribute()
    {
        return $this->engine?->name;
    }

    public function getDateAttribute()
    {
        return $this->created_at->format(config('listing.date_format'));
    }

    public function getIsFeaturedAttribute()
    {
        return $this->where('id',$this->id)->featured()->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Listing::class, 'favorite_listings');
    }

    public function comparedBy()
    {
        return $this->belongsToMany(User::class, 'compares');
    }

    public function getViewsAttribute()
    {
        return $this->visitLogs()->count();
    }

    public function getShowableAttribute()
    {
        return $this->user->subscribed();
    }

    public function contentRender()
    {
        if (!$this->content) {
            return '';
        }

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

    public function scopeApproved($sql)
    {
        return $sql->where('status', \App\Enums\ListingStatus::APPROVED);
    }

    public function scopePending($sql)
    {
        return $sql->where('status', \App\Enums\ListingStatus::PENDING);
    }

    public function scopeRejected($sql)
    {
        return $sql->where('status', \App\Enums\ListingStatus::REJECTED);
    }

    public function scopeExpirated($sql)
    {
        return $sql->whereDate('listing_expirate', '<=', now());
    }

    public function scopeNotExpirated($sql)
    {
        return $sql->whereDate('listing_expirate', '>', now())
                    ->orWhereNull('listing_expirate');
    }

    public function scopeFeatured($sql)
    {
        return $sql->WhereDate('featured_expirate', '>', now())
                    ->orWhere('is_featured', true);
    }

    public function scopeCertified($sql)
    {
        return $sql->where('is_certified', true);
    }

    public function scopeSorting($sql)
    {
        return $sql
            ->approved()
            ->NotExpirated()
            ->withCount('visitLogs')
            ->orderByDesc('visit_logs_count')
            ->orderByDesc('is_featured')
            ->orderByDesc('is_certified')
            ->orderByDesc('is_single_owner')
            ->orderByDesc('is_well_equipped')
            ->orderByDesc('no_accident')
            ->orderByDesc('is_city_mpg_verified')
            ->orderByDesc('is_highway_mpg_verified')
            ->orderBy('mileage')
            ->orderByDesc('is_mileage_verified')
            ->orderByDesc('is_negotiated')
            ->orderByDesc('year')
            ->orderByDesc('created_at');
    }

    public function scopeWithVideo($query)
    {
        return $query->whereNotNull('video_link');
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
