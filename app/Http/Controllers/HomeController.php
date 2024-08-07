<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Feature;
use App\Models\Listing;
use App\Models\Make;
use App\Models\Page;
use App\Models\User;
use App\Repositories\ListingInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Spatie\Newsletter\Facades\Newsletter;

class HomeController extends Controller
{
    protected $listings;

    public function __construct(ListingInterface $listings)
    {
        $this->listings = $listings;
    }

    public function home()
    {
        $page = Page::where('slug', config('listing.slug_home'))->first();

        return view('home', compact('page'));
    }

    public function contactSubmit(Request $request)
    {

        $validated = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'subject' => ['required', 'in_array:' . config('listing.subjects_contact')],
            'message' => 'required'
        ]);

        Contact::create($validated);

        nt('success', __('Submitted form'));

        return back();
    }

    public function favorites()
    {
        $listings = $this->listings->getFavorites();

        return view('listing.favorites', compact('listings'));
    }

    public function compares()
    {
        $features = Feature::all();
        $listings = $this->listings->getCompares();

        return view('listing.compares', compact('listings', 'features'));
    }

    public function newsletterAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        Newsletter::subscribe($request->email);

        return response()->json(['success' => __('Subscribed successfully')]);
    }

    public function addFavorite(Request $request)
    {
        $user = auth()->user();
        $listing = $this->listings->findById($request->listing);

        if ($user->hasFavorited($listing->id)) {
            $user->favoritedListings()->detach($listing);
            Cache::flush();
            return response()->json(['message' => 'Listing removed from favorite']);
        }

        if (!$user || !$listing) {
            return response()->json(['error' => 'User or listing not found'], 404);
        }

        $user->favoritedListings()->attach($listing);

        Cache::flush();

        return response()->json(['message' => 'Listing added to favorite']);
    }

    public function addCompare(Request $request)
    {
        $user = auth()->user();
        $listing = $this->listings->findById($request->listing);

        if ($user->hasCompared($listing->id)) {
            $user->comparedListings()->detach($listing);
            Cache::flush();
            return response()->json(['message' => 'Listing removed from compare']);
        }

        if ($user->comparedListings()->count() >= 3) {
            return response()->json(['message' => 'Limit for compare']);
        }

        if (!$user || !$listing) {
            return response()->json(['error' => 'User or listing not found'], 404);
        }

        $user->comparedListings()->attach($listing);

        Cache::flush();

        return response()->json(['message' => 'Listing added to compare']);
    }

    public function compare()
    {
        return view('compare');
    }

    public function addComparison($userId, $listingId)
    {
        $user = User::find($userId);
        $listing = Listing::find($listingId);

        if (!$user || !$listing) {
            return response()->json(['error' => 'User or listing not found'], 404);
        }

        $user->comparedListings()->attach($listing);

        return response()->json(['message' => 'Listing added to comparisons']);
    }

    public function consultSubmit(Request $request)
    {
        $validated = $request->validate([
            'fullname' => auth()->user() ? 'nullable' : 'required|string|max:255',
            'email' => auth()->user() ? 'nullable' : 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'booking_date' => 'nullable|date',
            'message' => 'required',
            'receiver' => 'required',
            'listing' => 'nullable'
        ]);

        if ($validated['receiver'] == auth()->id()) {
            nt('error', __('No need to send a consult to yourself'));
            return back();
        }

        $consult = new \App\Models\Consult();
        $consult->fullname = auth()->user()?->full_name ?? $validated['fullname'];
        $consult->email = auth()->user()?->email ?? $validated['email'];
        $consult->phone = auth()->user()?->phone ?? ($validated['phone'] ?? '');
        $consult->booking_date = $validated['booking_date'] ?? null;
        $consult->message = $validated['message'];
        $consult->sender_id = auth()->user()?->id ?? null;

        if (isset($validated['listing'])) {
            $listing = $this->listings->findById($validated['listing']);
            $consult->listing_id = $listing->id;
            $consult->receiver_id = $listing->user->id;
        } else {
            $consult->receiver_id = $validated['receiver'];
        }
        $consult->save();

        nt('success', __('Messaged submitted'));

        return back();
    }
}
