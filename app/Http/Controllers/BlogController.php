<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {

        $query = request()->input('q');
        $queryCategory = request()->input('category');
        $querySort = request()->input('sort');
        $queryTag = request()->input('tag');

        $titlePage = $query == '' ?  __('Blog') : __('Result for ":q"', ['q' => $query]);

        $featuredPost = Post::where('is_featured', 1)->latest()->with('category', 'user')->first();

        $features = Post::where('id', '!=', $featuredPost?->id)->where('is_featured', 1)->latest()->with('category', 'user')->limit(2)->get();

        $posts = Post::query()
            ->published()
            ->when(count(request()->query()) == 0 && $featuredPost, function ($sql) use ($featuredPost, $features) {
                return $sql->where('id', '!=', $featuredPost->id)
                    ->whereNotIn('id', $features->pluck('id'));
            })
            ->when($queryCategory, function ($sql) use ($queryCategory) {
                return $sql->where('category_id', $queryCategory);
            })
            ->when($queryTag, function ($sql) use ($queryTag) {
                return $sql->withAnyTags($queryTag);
            })
            ->where(function ($sql) use ($query) {
                return $sql
                    ->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->orderBy('id', $querySort ?? 'desc')
            ->with('category', 'user')
            ->paginate(6);

        $categories = Category::select('name', 'id')->get()->mapWithKeys(fn ($cat) => [$cat->id => $cat->name]);
        $tags = Tag::select('name', 'id')->get()->mapWithKeys(fn ($tag) => [$tag->id => $tag->name]);

        return view('blog.index', compact('titlePage', 'featuredPost', 'features', 'posts', 'categories', 'query', 'queryCategory', 'querySort', 'tags', 'queryTag'));
    }

    public function show(Post $post)
    {
        $post->load('category');

        visitor()->visit($post);

        $related = Post::published()
            ->where('id', '!=', $post->id)->where('category_id', $post->category?->id)->limit(3)->with('category', 'user')->get();

        if ($related->count() == 0) {
            $related = Post::where('id', '!=', $post->id)->limit(3)->with('category', 'user')->get();
        }

        return view('blog.show', compact('post', 'related'));
    }
}
