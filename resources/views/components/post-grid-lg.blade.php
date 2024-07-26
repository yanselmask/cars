 <article class="col pb-2 pb-md-1">
     <a class="d-block position-relative mb-3" href="{{route('blog.show', $post)}}">
        @if ($post->created_at->diffInDays(now()) <= config('listing.badge_new_post_time'))
         <span class="badge bg-info position-absolute top-0 end-0 m-3 fs-sm">{{__('New')}}</span>
         @endif
         <img class="d-block rounded-3" src="{{$post->medium_image}}" alt="{{ $post->name }}"></a>
     @if ($post->category)
         <a class="fs-sm text-uppercase text-decoration-none" href="{{route('blog.index', ['category' => $post->category->id])}}">{{ $post->category->name }}</a>
     @endif
     <h3 class="h5 text-light mb-2 pt-1">
         <a class="nav-link" href="{{route('blog.show', $post)}}">
             {{ $post->name }}
         </a>
     </h3>
     @if ($desc = $post->description)
         <p class="text-light opacity-70 mb-3">{{ $desc }}</p>
     @endif
     <a class="d-flex align-items-center text-decoration-none" href="#">
         @if($post->user)
         <img class="rounded-circle" src="{{$post->user->profile_photo_url}}" width="48" alt="{{$post->user->fullname}}">
         @endif
         <div class="ps-2">
             @if($post->user)
             <h6 class="fs-base text-light lh-base mb-1">{{$post->user->fullname}}</h6>
             @endif
             <div class="d-flex fs-sm text-light opacity-70">
                 <span class="me-2 pe-1"><i class="fi-calendar-alt opacity-70 mt-n1 me-1 align-middle"></i>{{$post->created_at->diffForHumans()}}</span>
             </div>
         </div>
     </a>
 </article>
