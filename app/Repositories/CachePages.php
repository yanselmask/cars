<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CachePages implements PagesInterface
{
    protected $pages;

    public function __construct(Pages $pages)
    {
        $this->pages = $pages;
    }

    public function findById($id)
    {
        $key = 'pages.id.' . $id;

        return Cache::rememberForever($key, function () use ($id) {
            return $this->pages->findById($id);
        });
    }
}
