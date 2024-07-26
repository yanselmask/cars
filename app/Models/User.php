<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Concerns\HasSuperAdmin;
use Filament\Panel;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spark\Billable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Shetabit\Visitor\Traits\Visitor;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use Billable, HasFactory, Visitor, Visitor, Notifiable, HasRoles, HasSuperAdmin;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'custom_fields',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            // 'custom_fields' => 'array'
        ];
    }


    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->isSuperAdmin() || str_ends_with($this->email, '@example.com');
        }

        return true;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url ? Storage::url("$this->avatar_url") : null;
    }

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->lastname;
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->avatar_url != '' ? Storage::url($this->avatar_url) : "https://www.gravatar.com/avatar/" . hash("sha256", strtolower(trim($this->email)));
    }

    public function getCreditsAttribute()
    {
        if (isset($this->sparkPlan()->options['listing'])) {
            return ($this->sparkPlan()->options['listing'] - $this->listings()->count());
        }

        return 0;
    }

    public function getCreditsFeaturesAttribute()
    {
        if (isset($this->sparkPlan()->options['listing_featured'])) {
            return ($this->sparkPlan()->options['listing_featured'] - $this->listings()->featured()->count());
        }

        return 0;
    }

    public function canPublishListing()
    {
        return $this->credits > 0 ? true : false;
    }

    public function canFeatureListing()
    {
        return $this->credits_features > 0 ? true : false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function listingsCertified()
    {
        return $this->listings()->where('is_certified', true);
    }

    public function favoritedListings()
    {
        return $this->belongsToMany(Listing::class, 'favorite_listings', 'user_id', 'listing_id')->approved();
    }

    public function hasFavorited($listingId)
    {
        return $this->favoritedListings()->where('listing_id', $listingId)->exists();
    }

    public function comparedListings()
    {
        return $this->belongsToMany(Listing::class, 'compares')->approved();
    }

    public function hasCompared($listingId)
    {
        return $this->comparedListings()->where('listing_id', $listingId)->exists();
    }

    public function getCustomFieldsJsonAttribute()
    {
        return json_decode($this->custom_fields);
    }

    public function getAddressAttribute()
    {
        return $this->custom_fields_json?->address;
    }

    public function getPhoneNumberAttribute()
    {
        return $this->custom_fields_json?->phone_number;
    }

    public function getWhatsappLinkAttribute()
    {
        return $this->custom_fields_json?->whatsapp;
    }

    public function getInstagramLinkAttribute()
    {
        return $this->custom_fields_json?->instagram;
    }

    public function getFacebookLinkAttribute()
    {
        return $this->custom_fields_json?->facebook;
    }
}
