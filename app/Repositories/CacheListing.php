<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CacheListing implements ListingInterface
{
    protected $listings;

    public function __construct(Listing $listings)
    {
        $this->listings = $listings;
    }

    public function getPaginated($limit = 8)
    {
        $key = 'listing.hash.' . md5(http_build_query(request()->query()));

        return Cache::rememberForever($key, function () use ($limit) {
            return $this->listings->getPaginated($limit);
        });
    }

    public function getFavorites()
    {
        $key = 'listing.favorites.by.' . auth()->user()?->id ?? 1;

        return Cache::rememberForever($key, function () {
            return $this->listings->getFavorites();
        });
    }

    public function getCompares()
    {
        $key = 'listing.compares.by.' . auth()->user()?->id ?? 1;

        return Cache::rememberForever($key, function () {
            return $this->listings->getCompares();
        });
    }

    public function getRelated($id, $limit = 6)
    {
        $key = 'listing.related.hash.' . md5(http_build_query(request()->query()));

        return Cache::rememberForever($key, function () use ($id, $limit) {
            return $this->listings->getRelated($id, $limit);
        });
    }

    public function getPaginateForVendor($userId, $limit = 6)
    {
        $key = 'listing.vendor.' . $userId . '.hash.' . md5(http_build_query(request()->query()));

        return Cache::rememberForever($key, function () use ($userId, $limit) {
            return $this->listings->getPaginateForVendor($userId, $limit);
        });
    }

    public function makemodelsJson($make)
    {
        $key = 'listing.makemodels';

        return Cache::rememberForever($key, function () use ($make) {
            return $this->listings->makemodelsJson($make);
        });
    }

    public function findById($id)
    {
        $key = 'listing.id.' . $id;

        return Cache::rememberForever($key, function () use ($id) {
            return $this->listings->findById($id);
        });
    }
}
