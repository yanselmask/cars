<div class="d-sm-flex align-items-end align-items-md-center justify-content-between position-relative mb-4"
     style="z-index: 1025;">
    <div class="me-3">
        <h1 class="h2 text-light mb-md-0">{{ $listing->name }}</h1>
        <div class="d-md-none">
            <div class="d-flex align-items-center mb-3">
                <div class="h3 mb-0 text-light">{{ $listing->pricing }}</div>
                <div class="text-nowrap ps-3">
                    <span class="badge bg-info fs-base me-2">{{ $listing->condition?->name }}</span>
                    @if ($listing->is_certified)
                        <span class="badge bg-success fs-base me-2" data-bs-toggle="popover"
                              data-bs-placement="bottom" data-bs-trigger="hover" data-bs-html="true"
                              data-bs-content="&lt;div class=&quot;d-flex&quot;&gt;&lt;i class=&quot;fi-award mt-1 me-2&quot;&gt;&lt;/i&gt;&lt;div&gt;{{ __('This car is checked and') }}&lt;br&gt;{{ __('certified by :site', ['site' => config('app.name')]) }}.&lt;/div&gt;&lt;/div&gt;">{{ __('Certified') }}</span>
                    @endif
                    @if ($listing->is_featured)
                        <span class="badge bg-danger fs-base me-2">{{ __('Featured') }}</span>
                    @endif
                </div>
            </div>
            @if($listing->miles || $listing->city_zip)
                <div class="d-flex flex-wrap align-items-center text-light mb-2">
                    @if($listing->miles)
                        <div class="text-nowrap @if($listing->city_zip) border-end border-light @endif pe-3 me-3">
                            <i class="fi-dashboard fs-lg opacity-70 me-2"></i>
                            <span class="align-middle">{{ $listing->miles }}</span>
                        </div>
                    @endif
                    @if($listing->city_zip)
                        <div class="text-nowrap">
                            <i class="fi-map-pin fs-lg opacity-70 me-2"></i>
                            <a href="{{route('listing.index', ['location' => $listing->city])}}" class="text-decoration-none text-light"><span class="align-middle">{{ $listing->city_zip }}</span></a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div class="text-nowrap pt-3 pt-sm-0">
        <button data-listing="{{ $listing->id }}"
                class="btn-favorite btn btn-icon btn-xs rounded-circle mb-sm-2 @auth {{ auth()->user()->hasFavorited($listing->id)? 'btn-danger': 'btn-translucent-light' }} @else btn-translucent-light @endauth"
                type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                title="@auth {{ auth()->user()->hasFavorited($listing->id)? __('Remove from favorite'): __('Add to favorite') }} @else {{ __('Add to favorite') }} @endauth">
            <i class="fi-heart"></i>
        </button>
    </div>
</div>
