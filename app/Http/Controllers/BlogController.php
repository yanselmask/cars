<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Repositories\PostsInterface;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected $posts;

    public function __construct(PostsInterface $posts)
    {
        $this->posts = $posts;
    }

    public function index()
    {

        $titlePage = request()->query('q') == '' ?  __('Blog') : __('Result for ":q"', ['q' => request()->query('q')]);

        $featuredPost = $this->posts->featuredPost();

        if ($featuredPost) {
            $features = $this->posts->getFeatureds($featuredPost->id);
        } else {
            $features = collect();
        }

        $posts = $this->posts->getPaginated($featuredPost, $features);

        $categories = Category::select('name', 'id')->get()->mapWithKeys(fn ($cat) => [$cat->id => $cat->name]);

        $tags = Tag::select('name', 'id')->get()->mapWithKeys(fn ($tag) => [$tag->id => $tag->name]);

        return view('blog.index', compact('titlePage', 'featuredPost', 'features', 'posts', 'categories', 'tags'));
    }

    public function show(Post $post)
    {
        abort_unless($post->actived,404);

        $post = $this->posts->findById($post->id);

        visitor()->visit($post);

        $related = $this->posts->getRelated($post->id);

        return view('blog.show', compact('post', 'related'));
    }
}
