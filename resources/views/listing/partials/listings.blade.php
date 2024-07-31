<div class="row">
    @foreach ($listings as $listing)
        @if (request()->query('view') == 'grid' || !request()->query('view') && config('listing.listing_result_view') == 'grid')
            <div class="col-lg-6 mb-4">
                <x-listing-grid :listing="$listing" />
            </div>
        @else
            <x-listing-list :listing="$listing" />
        @endif
    @endforeach
</div>
{{$listings->withQueryString()->links()}}
