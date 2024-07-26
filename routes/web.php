<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)
    ->group(function () {
        Route::get('/', 'home')->name('home');
        Route::get('/favorites', 'favorites')->name('favorites');
        Route::get('/compares', 'compares')->name('compares');
        Route::post('/newsletter/add', 'newsletterAdd')->name('newsletter.add');
        Route::post('/contact/submit', 'contactSubmit')->name('contact.submit');
        Route::post('/consult/submit', 'consultSubmit')->name('consult.submit');
        Route::middleware('auth')
            ->group(function () {
                Route::post('/add/favorite/listing', 'addFavorite')->name('add.favorite.listing');
                Route::post('/add/compare/listing', 'addCompare')->name('add.compare.listing');
            });
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
        Route::get('/{listing}', 'show')->name('listing.show');
        Route::get('/models/{make}', 'makemodelsJson')->name('listing.modelsjson');
        Route::get('/vendor/{user}', 'vendor')->name('listing.vendor');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';
