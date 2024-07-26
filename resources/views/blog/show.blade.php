<x-app-layout>
        @push('seo')
        {!! seo()->for($post) !!}
    @endpush
    <div class="container pt-5 pb-lg-4 my-5">
        <!-- Breadcrumb-->
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
        <!-- Page title-->
        <h1 class="h2 text-light pb-3">{{ $post->name }}</h1>
        <img class="rounded-3" src="{{ $post->single_image }}" alt="{{ $post->name }}">
        <div class="row mt-4 pt-3">
            <!-- Post content-->
            <div class="col-lg-8">
                <!-- Post meta-->
                <div class="d-flex flex-wrap border-bottom border-light pb-3 mb-4">
                    <div class="d-flex align-items-center text-light border-end border-light pe-3 me-3 mb-2"><i
                            class="fi-calendar-alt opacity-70 me-2"></i><span>{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                {!! $post->contentRender() !!}
                <!-- Tags + Sharing-->
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
                        <div class="d-flex align-items-center">
                            <div class="text-light fw-bold text-nowrap pe-1 mb-2">{{ __('Share') }}:</div>
                            <div class="d-flex"><a
                                    class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 ms-2"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
                                    data-bs-toggle="tooltip" title="{{ __('Share with Facebook') }}"><i
                                        class="fi-facebook"></i></a><a
                                    class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 ms-2"
                                    href="https://twitter.com/intent/tweet?url={{ request()->url() }}&text={{ $post->description }}"
                                    data-bs-toggle="tooltip" title="{{ __('Share with Twitter') }}"><i
                                        class="fi-twitter"></i></a><a
                                    class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 ms-2"
                                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ request()->url() }}"
                                    data-bs-toggle="tooltip" title="{{ __('Share with LinkedIn') }}"><i
                                        class="fi-linkedin"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar-->
            <x-sidebar-blog :post="$post" :related="$related" />
        </div>
    </div>
</x-app-layout>
