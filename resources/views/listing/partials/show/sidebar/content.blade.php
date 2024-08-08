<div class="d-none d-md-block pt-5">
    <div class="d-flex mb-4">
        <span class="badge bg-info fs-base me-2">{{ $listing->condition?->name }}</span>
        @if ($listing->is_certified)
            <span class="badge bg-success fs-base me-2" data-bs-toggle="popover"
                  data-bs-placement="top" data-bs-trigger="hover" data-bs-html="true"
                  data-bs-content="&lt;div class=&quot;d-flex&quot;&gt;&lt;i class=&quot;fi-award mt-1 me-2&quot;&gt;&lt;/i&gt;&lt;div&gt;{{ __('This car is checked and') }}&lt;br&gt;{{ __('certified by :site', ['site' => config('app.name')]) }}.&lt;/div&gt;&lt;/div&gt;">{{ __('Certified') }}</span>
        @endif
        @if ($listing->is_featured)
            <span class="badge bg-danger fs-base me-2">{{ __('Featured') }}</span>
        @endif
    </div>
    <div class="h3 text-light">{{ $listing->pricing }}</div>
    @if($listing->miles || $listing->city_zip)
        <div class="d-flex align-items-center text-light pb-4 mb-2">
            @if($listing->miles)
                <div class="text-nowrap  @if($listing->city_zip) border-end border-light @endif pe-3 me-3">
                    <i class="fi-dashboard fs-lg opacity-70 me-2"></i>
                    <span class="align-middle">{{ $listing->miles }}</span>
                </div>
            @endif
            @if($listing->city_zip)
                <div class="text-nowrap">
                    <i class="fi-map-pin fs-lg opacity-70 me-2"></i>
                    <a href="{{route('listing.index',['location' => $listing->city])}}" class="text-decoration-none text-light" ><span class="align-middle">{{ $listing->city_zip }}</span></a>
                </div>
            @endif
        </div>
    @endif
</div>
{{apply_filters( 'section_before_vendor_listing_show', null )}}
