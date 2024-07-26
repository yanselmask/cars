<article class="row pb-2 pb-md-1 mb-4 mb-md-5">
    <div class="col-md-7 col-lg-8 mb-lg-0 mb-3 mb-md-0">
        <a class="d-block position-relative" href="{{route('blog.show', $post)}}">
            @if ($post->created_at->diffInDays(now()) <= config('listing.badge_new_post_time'))
            <span class="badge bg-info position-absolute top-0 end-0 m-3 fs-sm">{{__('New')}}</span>
            @endif
            <img class="rounded-3" src="{{$post->large_image}}" alt="{{$post->name}}">
        </a>
    </div>
    <div class="col-md-5 col-lg-4">
        @if($post->category)
        <a class="fs-sm text-uppercase text-decoration-none" href="{{route('blog.index', ['category' => $post->category->id])}}">{{$post->category->name}}</a>
        @endif
        <h2 class="h5 text-light pt-1">
            <a class="nav-link" href="{{route('blog.show', $post)}}">
                {{$post->name}}
            </a>
        </h2>
        @if($desc = $post->description)
        <p class="d-md-none d-xl-block text-light opacity-70 mb-4">
            {{$desc}}
        </p>
        @endif
        <a class="d-flex align-items-center text-decoration-none" href="#">
            @if($post->user)
            <img class="rounded-circle" src="{{$post->user->profile_photo_url}}" width="48" alt="{{$post->user->name}}">
            @endif
            <div class="ps-2">
                @if($name = $post->user?->fullname)
                <h6 class="fs-base text-light lh-base mb-1">{{$name}}</h6>
                @endif
                <div class="d-flex fs-sm text-light opacity-70">
                    <span class="me-2 pe-1"> <i class="fi-calendar-alt opacity-70 mt-n1 me-1"></i>{{$post->created_at->diffForHumans()}}</span>
                </div>
            </div>
        </a>
    </div>
</article>
