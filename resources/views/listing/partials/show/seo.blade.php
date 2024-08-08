@push('seo')
    @if(!$listing->seo->image)
        <meta property="og:image" content="{{ $listing->media[0]->getUrl('single') }}">
    @endif
    {!! seo()->for($listing) !!}
@endpush
