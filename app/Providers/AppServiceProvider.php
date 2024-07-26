<?php

namespace App\Providers;

use App\Listeners\IncrementListingToUser;
use App\Models\User;
use App\Repositories\CacheListing;
use App\Repositories\CachePages;
use App\Repositories\CachePosts;
use App\Repositories\ListingInterface;
use App\Repositories\PagesInterface;
use App\Repositories\PostsInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Facades\Menu;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Laravel\Paddle\Events\SubscriptionCreated;
use Laravel\Paddle\Events\SubscriptionUpdated;

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
        $this->app->bind(ListingInterface::class, CacheListing::class);
        $this->app->bind(PostsInterface::class, CachePosts::class);
        $this->app->bind(PagesInterface::class, CachePages::class);

        Gate::before(function (User $user, string $ability) {
            return $user->isSuperAdmin() || $user->email == config('listing.super_admin_email') || $user->id == 1 ? true : null;
        });

        Paginator::useBootstrapFive();
    }
}
