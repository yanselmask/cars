@php
    $posts = \App\Models\Post::query()
    ->published()
    ->limit($data['limit'])
    ->orderByDesc('created_at')
    ->get()
@endphp
<section class="container pb-4 pb-sm-5 mb-2 mb-md-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-3 mb-sm-4 pb-sm-2">
        <h2 class="h3 text-light mb-2 mb-sm-0">{{$data['title']}}</h2>
        <a class="btn btn-link btn-light fw-normal px-0"
            href="{{route('blog.index')}}">{{__('Go to blog')}}<i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i></a>
    </div>
    <div class="tns-carousel-wrapper tns-nav-outside tns-carousel-light">
        <div class="tns-carousel-inner"
            data-carousel-options="{&quot;items&quot;: {{$posts->count()}}, &quot;controls&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;gutter&quot;: 24}}}">
            @each('components.post-grid-md', $posts, 'post')
        </div>
    </div>
</section>
