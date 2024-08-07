@if(viewActive('grid'))
<div class="row">
    @endif
    @if(viewActive('grid') || viewActive('list'))
    @forelse ($listings as $listing)
        @if (viewActive('grid'))
            <div class="col-lg-6 mb-4">
                <x-listing-grid :listing="$listing" />
            </div>
            @else
                <x-listing-list :listing="$listing" />
        @endif
    @empty
        @include('listing.partials.no-listings')
    @endforelse
        @elseif(viewActive('short'))
        <x-listing-short :listings="$listings" />
    @else
        @include('listing.partials.map')
    @endif
    @if(viewActive('grid'))
</div>
@endif
{{$listings->withQueryString()->links()}}
