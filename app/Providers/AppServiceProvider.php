<?php

namespace App\Providers;

use App\Events\ListingWasCreated;
use App\Listeners\ListingWasCreatedNotifyToUserListener;
use App\Models\User;
use App\Repositories\ListingInterface;
use App\Repositories\PagesInterface;
use App\Repositories\PostsInterface;
use App\View\Components\BannerAfterFormVendorListings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ListingInterface::class, config('listing.repository_listing'));
        $this->app->bind(PostsInterface::class, config('listing.repository_posts'));
        $this->app->bind(PagesInterface::class, config('listing.repository_pages'));

        add_filter('section_after_form_vendor_listings', function(){
            $component = new BannerAfterFormVendorListings();
            return $component->render();
        });

        Gate::before(function (User $user, string $ability) {
            return $user->isSuperAdmin() || $user->email == config('listing.super_admin_email') || $user->id == 1 ? true : null;
        });

        Gate::define('use-translation-manager', function (?User $user) {
            // Your authorization logic
            return $user->isSuperAdmin() || $user->email == config('listing.super_admin_email');
        });

        Paginator::useBootstrapFive();

        NavigationResource::navigationGroup('Settings');
        NavigationResource::navigationSort(3);

        Event::listen(
            ListingWasCreated::class,
            ListingWasCreatedNotifyToUserListener::class,
        );

    }
}
