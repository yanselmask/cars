<div class="pt-4 pb-5 mb-md-3">
    <div class="d-md-flex align-items-center justify-content-between border-top border-light pt-4">
        @if ($post->tags->count() > 0)
            <div class="d-flex align-items-center me-3 mb-3 mb-md-0">
                <div class="d-none d-sm-block text-light fw-bold text-nowrap mb-2 me-2 pe-1">
                    {{ __('Tags') }}:</div>
                <div class="d-flex flex-wrap">
                    @foreach ($post->tags as $tag)
                        <a class="btn btn-xs btn-translucent-light rounded-pill fs-sm fw-normal me-2 mb-2"
                           href="{{route('blog.index', ['tag' => $tag->name])}}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        @endif
        <!-- Share -->
            @include('blog.partials.show.share')
    </div>
</div>
