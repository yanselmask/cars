<h1 class="h2 text-light pb-3">{{ $post->name }}</h1>
<img class="rounded-3" src="{{ $post->single_image }}" alt="{{ $post->name }}">
<div class="row mt-4 pt-3">
    <!-- Post content-->
    <div class="col-lg-8">
        <!-- Post meta-->
        @include('blog.partials.show.meta')
        <!-- Post Content-->
        @include('partials.blocks.renderBlock',['data' => $post->content])
        <!-- Tags + Sharing-->
        @include('blog.partials.show.tags')
    </div>
    <!-- Sidebar-->
    <x-sidebar-blog :post="$post" :related="$related" />
</div>
