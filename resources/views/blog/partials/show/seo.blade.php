@push('seo')
    @if(!$post->seo->image && count($post->media))
        <meta property="og:image" content="{{ $post->media[0]->getUrl('single') }}">
    @endif
    {!! seo()->for($post) !!}
@endpush
