<x-breadcrumb :routes="[
            [
                'name' => __('Home'),
                'link' => route('home'),
            ],
            [
                'name' => __('Blog'),
                'link' => route('blog.index'),
            ],
             [
                'name' => $post->category->name,
                'link' => route('blog.index',['category' => $post->category->id]),
            ],
        ]" active="{{ $post->name }}" />
