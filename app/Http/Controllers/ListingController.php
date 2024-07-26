<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\MakeModel;
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
        $listings = $this->listings->getPaginated();

        return view('listing.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        $listing = $this->listings->findById($listing->id);

        visitor()->visit($listing);

        $related = $this->listings->getRelated($listing->id);

        return view('listing.show', compact('listing', 'related'));
    }

    public function makemodelsJson($make)
    {
        $models = $this->listings->makemodelsJson($make);

        return response()->json([
            'data' => $models
        ]);
    }

    public function vendor(User $user)
    {
        $listings = $this->listings->getPaginateForVendor($user->id);

        return view('listing.vendor', compact('user', 'listings'));
    }
}
