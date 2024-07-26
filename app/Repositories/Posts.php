<?php

namespace App\Repositories;

use App\Models\Post;

class Posts implements PostsInterface
{
    public function getPaginated($featuredPost, $featureds, $limit = 6)
    {
        $posts = Post::query()
            ->published()
            ->when(count(request()->query()) == 0 && $featuredPost, function ($sql) use ($featuredPost, $featureds) {
                return $sql->where('id', '!=', $featuredPost->id)
                    ->whereNotIn('id', $featureds->pluck('id'));
            })
            ->when(request()->query('category'), function ($sql) {
                return $sql->where('category_id', request()->query('category'));
            })
            ->when(request()->query('tag'), function ($sql) {
                return $sql->withAnyTags(request()->query('tag'));
            })
            ->when(request()->query('q'), function ($sql) {
                $sql->where(function ($query) {
                    return $query
                        ->where('name', 'like', '%' . request()->query('q') . '%')
                        ->orWhere('description', 'like', '%' . request()->query('q') . '%')
                        ->orWhere('content', 'like', '%' . request()->query('q') . '%');
                });
            })
            ->orderBy('id', request()->query('sort') ?? 'desc')
            ->with('category', 'user', 'tags')
            ->paginate($limit);

        return $posts;
    }

    public function getRelated($id, $limit = 3)
    {
        $post = $this->findById($id);

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category?->id)
            ->with('category', 'user', 'tags')
            ->paginate($limit);

        if ($related->count() == 0) {
            $related = Post::where('id', '!=', $post->id)
                ->with('category', 'user', 'tags')
                ->paginate($limit);
        }

        return $related;
    }

    public function getFeatureds($id, $limit = 2)
    {
        return Post::where('id', '!=', $id)
            ->where('is_featured', true)
            ->latest()
            ->with('category', 'user', 'tags')
            ->paginate($limit);
    }

    public function findById($id)
    {
        return Post::where('id', $id)
            ->with('category', 'user', 'tags')
            ->first();
    }

    public function featuredPost()
    {
        return Post::where('is_featured', 1)
            ->with('category', 'user', 'tags')
            ->latest()
            ->first();
    }
}
