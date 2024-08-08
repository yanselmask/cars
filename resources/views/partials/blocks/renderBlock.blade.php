@foreach($data as $item)
    @switch($item['type'])
        @case('heading')
            @include('partials.blocks.heading', ['data' => $item['data']])
        @break
        @case('paragraph')
            @include('partials.blocks.paragraph', ['data' => $item['data']])
            @break
        @case('blockquote')
            @include('partials.blocks.blockquote', ['data' => $item['data']])
            @break
        @case('video')
            @include('partials.blocks.video', ['data' => $item['data']])
            @break
        @case('gallery')
            @include('partials.blocks.gallery', ['data' => $item['data']])
            @break
        @case('listing')
            @include('partials.blocks.listing', ['data' => $item['data']])
            @break
        @case('map')
            @include('partials.blocks.map', ['data' => $item['data']])
            @break
        @case('app_mobile')
            @include('sections.app_mobile', ['data' => $item['data']])
            @break
        @case('partners')
            @include('sections.partners', ['data' => $item['data']])
            @break
        @case('posts')
            @include('partials.blocks.posts', ['data' => $item['data']])
            @break
    @endswitch
@endforeach
