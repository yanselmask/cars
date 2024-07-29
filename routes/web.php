<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/update',function(){
    if(auth()->user()?->isSuperAdmin())
    {
        Artisan::call('migrate',[
            '--force' => true,
        ]);

        Artisan::call('optimize:clear');

        return back();
    }
});
Route::middleware([
    \Illuminate\Session\Middleware\AuthenticateSession::class,
])->group(function () {
    Route::controller(HomeController::class)
        ->group(function () {
            Route::post('/add/favorite/listing', 'addFavorite')->name('add.favorite.listing');
            Route::post('/add/compare/listing', 'addCompare')->name('add.compare.listing');
        });
});

Route::middleware([
    \Shipu\WebInstaller\Middleware\RedirectIfNotInstalled::class,
    \Torann\Currency\Middleware\CurrencyMiddleware::class,
    'language'
])->group(function () {
    Route::controller(HomeController::class)
        ->group(function () {
            Route::get('/', 'home')->name('home');
            Route::get('/' . config('listing.path_favorites', 'favorites'), 'favorites')->name('favorites');
            Route::get('/' . config('listing.path_compares', 'compares'), 'compares')->name('compares');
            Route::post('/newsletter/add', 'newsletterAdd')->name('newsletter.add');
            Route::post('/contact/submit', 'contactSubmit')->name('contact.submit');
            Route::post('/consult/submit', 'consultSubmit')->name('consult.submit');
        });

    Route::controller(BlogController::class)
        ->prefix(config('listing.path_blog'))
        ->group(function () {
            Route::get('/', 'index')->name('blog.index');
            Route::get('/{post}', 'show')->name('blog.show');
        });

    Route::controller(PageController::class)
        ->prefix(config('listing.path_page'))
        ->group(function () {
            Route::get('/{page}', 'show')->name('pages.show');
        });

    Route::controller(ListingController::class)
        ->prefix(config('listing.path_listing'))
        ->group(function () {
            Route::get('/', 'index')->name('listing.index');
            Route::get('/models/{make}', 'makemodelsJson')->name('listing.modelsjson');
            Route::get('/' . config('listing.path_vendors'), 'vendors')->name('listing.vendors');
            Route::get('/' . config('listing.path_vendors') . '/{user}', 'vendor')->name('listing.vendor');
            Route::get('/{listing}', 'show')->name('listing.show');
        });
});
