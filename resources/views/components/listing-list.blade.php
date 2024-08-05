<div class="{{ $class }} listing">
    <div class="tns-carousel-wrapper card-img-top card-img-hover">
        <a class="img-overlay" href="{{ route('listing.show', $listing) }}"></a>
        @include('components.badges-listing')
        @include('components.listing-button-like')
        @foreach ($listing->media as $photo)
        @endforeach
        <div class="tns-carousel-inner position-absolute top-0 h-100">
            @foreach ($listing->media as $photo)
                <div loading="lazy" class="bg-size-cover bg-position-center w-100 h-100"
                    style="background-image: url({{ $photo->getUrl($thumb) }});"></div>
            @endforeach
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between pb-1"><span
                class="fs-sm text-light me-3">{{ $listing->year }}</span>
                <div class="form-check form-check-light compare-check d-none">
                    <input data-listing="{{ $listing->id }}" class="form-check-input btn-compare" type="checkbox"
                        id="compare-{{ $listing->id }}" @auth
@checked(auth()->user()->hasCompared($listing->id)) @endauth>
                    <label class="form-check-label fs-sm" for="compare-{{ $listing->id }}">{{ __('Compare') }}</label>
                </div>
        </div>
        <h3 class="h6 mb-1">
            <a class="nav-link-light" href="{{ route('listing.show', $listing) }}">
                {{ $listing->name }}
            </a>
        </h3>
        <div class="text-primary fw-bold mb-1">{{ $listing->pricing }}</div>
        <div class="fs-sm text-light opacity-70"><i class="fi-map-pin me-1"></i>{{ $listing->city }}</div>
        <div class="border-top border-light mt-3 pt-3">
            <div class="row g-2">
                <div class="col me-sm-1">
                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i
                            class="fi-dashboard d-block h4 text-light mb-0 mx-center"></i><span
                            class="fs-xs text-light">{{ $listing->miles }}</span>
                    </div>
                </div>
                <div class="col me-sm-1">
                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i
                            class="fi-gearbox d-block h4 text-light mb-0 mx-center"></i><span
                            class="fs-xs text-light">{{ $listing->transmission?->name }}</span></div>
                </div>
                <div class="col">
                    <div class="bg-dark rounded text-center w-100 h-100 p-2"><i
                            class="fi-petrol d-block h4 text-light mb-0 mx-center"></i><span
                            class="fs-xs text-light">{{ $listing->fueltype?->name }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
