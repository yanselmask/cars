<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        visitor()->visit($page);

        if (config('listing.slug_home') == $page->slug) {
            return redirect()->route('home');
        }

        return view('pages.show', compact('page'));
    }
}
