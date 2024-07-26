<?php

namespace App\Providers;

use App\Listeners\IncrementListingToUser;
use App\Models\User;
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
        Gate::before(function (User $user, string $ability) {
            return $user->isSuperAdmin() || str_ends_with($user->email, '@example.com') ? true : null;
        });

        Paginator::useBootstrapFive();

        //Menus
        Menu::macro('main', function () {
            return Menu::new()
                ->add(
                    Link::toRoute('home', __('Home'))
                        ->setParentAttribute('class', 'nav-item')
                        ->setAttribute('class', 'nav-link')
                        ->setActive(setActive('home'))
                )
                ->add(
                    Link::toRoute('blog.index', __('Blog'))
                        ->setParentAttribute('class', 'nav-item')
                        ->setAttribute('class', 'nav-link')
                        ->setActive(setActive('blog.index'))
                )
                ->add(
                    Link::toRoute('favorites', __('Favorites'))
                        ->setParentAttribute('class', 'nav-item')
                        ->setAttribute('class', 'nav-link')
                        ->setActive(setActive('favorites'))
                )
                ->add(
                    Link::toRoute('compares', __('Compare'))
                        ->setParentAttribute('class', 'nav-item')
                        ->setAttribute('class', 'nav-link')
                        ->setActive(setActive('compares'))
                )
                ->add(
                    Link::to(config('app.url') . '/' . config('listing.path_page') . '/contact-us', __('Contact us'))
                        ->setParentAttribute('class', 'nav-item')
                        ->setAttribute('class', 'nav-link')
                        ->setActive(request()->path() == config('listing.path_page') . '/contact-us')
                )
                // ->submenu(
                //     Html::raw('<a class="nav-link dropdown-toggle" href="#" role="button"
                // data-bs-toggle="dropdown" aria-expanded="false">More</a>'),
                //     Menu::new()
                //         ->addClass('dropdown-menu dropdown-menu-dark')
                //         ->add(
                //             Link::to('/', __('Home'))
                //                 ->addClass('dropdown-item')
                //                 ->setAttribute('class', 'nav-link')
                //         )
                //         ->addParentClass('nav-item dropdown')
                // )
                ->addClass('navbar-nav navbar-nav-scroll')
                ->setAttribute('style', 'max-height: 35rem;');
        });
        Menu::macro('footer_widget_1', function () {
            return Menu::new()
                ->add(
                    Html::raw('<h3 class="fs-base text-light">Buying &amp; Selling</h3>')
                )
                ->add(
                    Link::to('/', __('Find a car'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Sell your car'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Car dealers'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Compare cars'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Online car appraisal'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->addClass('list-unstyled fs-sm');
        });
        Menu::macro('footer_widget_2', function () {
            return Menu::new()
                ->add(
                    Html::raw('<h3 class="fs-base text-light">About</h3>')
                )
                ->add(
                    Link::to('/', __('Find a car'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Sell your car'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Car dealers'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Compare cars'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Online car appraisal'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->addClass('list-unstyled fs-sm');
        });
        Menu::macro('footer_widget_3', function () {
            return Menu::new()
                ->add(
                    Html::raw('<h3 class="fs-base text-light">Profile</h3>')
                )
                ->add(
                    Link::to('/', __('Find a car'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Sell your car'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Car dealers'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Compare cars'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->add(
                    Link::to('/', __('Online car appraisal'))
                        ->setAttribute('class', 'nav-link-light')
                )
                ->addClass('list-unstyled fs-sm');
        });
        Menu::macro('footer_bottom', function () {
            return Menu::new()
                ->add(
                    Link::to('/', __('Find a car'))
                        ->setAttribute('class', 'nav-link nav-link-light fw-normal me-2')
                )
                ->add(
                    Link::to('/', __('Sell your car'))
                        ->setAttribute('class', 'nav-link nav-link-light fw-normal me-2')
                )
                ->add(
                    Link::to('/', __('Car dealers'))
                        ->setAttribute('class', 'nav-link nav-link-light fw-normal me-2')
                )
                ->add(
                    Link::to('/', __('Compare cars'))
                        ->setAttribute('class', 'nav-link nav-link-light fw-normal me-2')
                )
                ->add(
                    Link::to('/', __('Online car appraisal'))
                        ->setAttribute('class', 'nav-link nav-link-light fw-normal me-2')
                )
                ->addClass('d-flex flex-wrap justify-content-center order-lg-2 mb-3 list-unstyled');
        });
    }
}
