<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Repositories\CachePages;
use App\Repositories\PagesInterface;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $pages;

    public function __construct(PagesInterface $pages)
    {
        $this->pages = $pages;
    }

    public function show(Page $page)
    {
        abort_unless($page->actived,404);

        $page = $this->pages->findById($page->id);

        visitor()->visit($page);

        if (config('listing.slug_home') == $page->slug) {
            return redirect()->route('home');
        }

        return view('pages.show', compact('page'));
    }
}
