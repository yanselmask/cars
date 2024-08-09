<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use App\Repositories\ListingInterface;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    protected $listings;

    public function __construct(ListingInterface $listings)
    {
        $this->listings = $listings;
    }

    public function index()
    {
       $listings = match(request()->query('view')){
           'map' => $this->listings->getPaginated(config('listing.items_paginate_for_view_map')),
           'short' => $this->listings->getShortsPaginated(config('listing.items_paginate_for_short_view')),
           default => $this->listings->getPaginated()
       };

        if(request()->has('markers'))
        {
            $coordinates =  config('listing.coordinates_default');
            $markers =  $listings->map(function (Listing $listing) {
                $route = route('listing.show', $listing);
                return [
                    'coordinates' => [(float) $listing->lat, (float) $listing->lng],
                    'iconUrl' => asset('theme/img/marker-car.png'),
                    'className' => 'custom-marker-icon',
                    'popup' => "<div class='card border-0'><a href='{$route}' class='d-block'><img src='{$listing->primary_image}' alt='{$listing->name}'></a><div class='card-body'><h5 class='card-title fs-base'><a href='{$route}' class='nav-link'>{$listing->name}</a></h5><div class='d-flex align-items-center mb-2'><div class='star-rating mt-n1 me-2'></div></div><div class='mb-2'><i class='fi-map-pin text-muted fs-sm mt-n1 me-1'></i>{$listing->city}</div><div><i class='fi-credit-card text-muted fs-sm mt-n1 me-1'></i>{$listing->pricing}</div></div></div>"
                ];
            });

            return response()->json([
                'mapLayer' => 'https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key=' . config('listing.map_api_key'),
                'coordinates' => $coordinates,
                'zoom' => config('listing.zoom_map_items'),
                'markers' => $markers
            ]);
        }

        return view('listing.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        abort_unless(( $listing->user && $listing->user->runningSubscription && $listing->status == \App\Enums\ListingStatus::APPROVED), 404);

        $listing = $this->listings->findById($listing->id);

        $related = $this->listings->getRelated($listing->id);

        if(request()->has('marker'))
        {
            $markers = [
                [
                    'coordinates' => [$listing->lat, $listing->lng],
                    'iconUrl' => asset('theme/img/marker-car.png'),
                    'className' => 'custom-marker-icon',
                    'popup' => "<div class='card border-0'><a href='#' class='d-block'><img src='{$listing->primary_image}' alt='{$listing->name}'></a><div class='card-body'><h5 class='card-title fs-base'><a href='#' class='nav-link'>{$listing->name}</a></h5><div class='d-flex align-items-center mb-2'><div class='star-rating mt-n1 me-2'></div></div><div class='mb-2'><i class='fi-map-pin text-muted fs-sm mt-n1 me-1'></i>{$listing->city}</div><div><i class='fi-credit-card text-muted fs-sm mt-n1 me-1'></i>{$listing->pricing}</div></div></div>"
                ]
            ];

            return response()->json([
                'mapLayer' => 'https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key=' . config('listing.map_api_key'),
                'coordinates' => [$listing->lat, $listing->lng],
                'zoom' => config('listing.zoom_map_show_listing'),
                'markers' => $markers
            ]);
        }

        return view('listing.show', compact('listing', 'related'));
    }

    public function makemodelsJson($make)
    {
        $models = $this->listings->makemodelsJson($make);

        return response()->json([
            'data' => $models,
        ]);
    }

    public function vendors()
    {
        $vendors = User::when(request()->query('city'), function ($query) {
             $query->whereLike('custom_fields->address', '%' . request()->query('city') . '%');
            })
            ->withCount([
                'listings' => function ($query) {
                    $query->approved();
                },
            ])
            ->withCount([
                'listings as certified_count' => function ($query) {
                    $query->approved()
                          ->certified();
                },
            ])
            ->withCount([
                'listings as featured_count' => function ($query) {
                    $query->approved()
                          ->featured();
                },
            ])
            ->HasSubscriptionActived()
            ->seller()
            ->withAvg('listings', 'price')
            ->orderByDesc('certified_count')
            ->orderByDesc('featured_count')
            ->orderByDesc('listings_count')
            ->orderBy('listings_avg_price')
            ->paginate(10);

        $locations = User::select('custom_fields')
            ->whereNotNull('custom_fields->address')
            ->distinct()
            ->get();

        return view('listing.vendors', compact('vendors', 'locations'));
    }

    public function vendor(User $user)
    {
        abort_unless($user->runningSubscription,404);

        $listings = $this->listings->getPaginateForVendor($user->id);

        return view('listing.vendor', compact('user', 'listings'));
    }
}
