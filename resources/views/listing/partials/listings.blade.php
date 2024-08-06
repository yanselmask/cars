@if(request()->query('view') == 'grid' || request()->query('view') == '')
<div class="row">
    @endif
    @if((request()->query('view') == 'grid' || !request()->query('view') && config('listing.listing_result_view') == 'grid') || request()->query('view') == 'list' || !request()->query('view') && config('listing.listing_result_view') == 'list')
    @forelse ($listings as $listing)
        @if (request()->query('view') == 'grid' || !request()->query('view') && config('listing.listing_result_view') == 'grid')
            <div class="col-lg-6 mb-4">
                <x-listing-grid :listing="$listing" />
            </div>
            @else
            <x-listing-list :listing="$listing" />
        @endif
    @empty
        @include('listing.partials.no-listings')
    @endforelse
    @else
        <!-- Complex options via external local .json file -->
        <div class="interactive-map"
             data-map-options-json="{{request()->fullUrlWithQuery([
            'markers' => true
                 ])}}"
             style="height: 600px;border-radius: 20px;"></div>
        <!-- Examples of .json files with map options you can find in dist/json folder -->
    @endif
    @if(request()->query('view') == 'grid' || request()->query('view') == '')
</div>
@endif
{{$listings->withQueryString()->links()}}
