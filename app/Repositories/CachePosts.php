<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CachePosts implements PostsInterface
{
    protected $posts;

    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }

    public function getPaginated($featuredPost, $featureds, $limit = 6)
    {
        $key = 'posts.hash.' . md5(http_build_query(request()->query()));

        return Cache::rememberForever($key, function () use ($featuredPost, $featureds, $limit) {
            return $this->posts->getPaginated($featuredPost, $featureds, $limit = 6);
        });
    }

    public function getRelated($id, $limit = 3)
    {
        $key = 'posts.related.by.' . $id;

        return Cache::rememberForever($key, function () use ($id, $limit) {
            return $this->posts->getRelated($id, $limit);
        });
    }

    public function getFeatureds($id, $limit = 2)
    {
        $key = 'posts.features.by.' . $id;

        return Cache::rememberForever($key, function () use ($id, $limit) {
            return $this->posts->getFeatureds($id, $limit);
        });
    }

    public function featuredPost()
    {
        $key = 'posts.featured.page.' . request()->query('page', 1);

        return Cache::rememberForever($key, function () {
            return $this->posts->featuredPost();
        });
    }

    public function findById($id)
    {
        $key = 'posts.id.' . $id;

        return Cache::rememberForever($key, function () use ($id) {
            return $this->posts->findById($id);
        });
    }
}
