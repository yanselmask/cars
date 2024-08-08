{{apply_filters( 'section_before_specifications_listing_show', null )}}
<div class="py-3 mb-3">
    <h2 class="h4 text-light mb-4">{{ __('Specifications') }}</h2>
    <div class="row text-light">
        <div class="col-sm-6 col-md-12 col-lg-6">
            <ul class="list-unstyled">
                <li class="mb-2"><strong>{{ __('Make') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->make?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('Model') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->makemodel?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('Mileage') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->miles }}</span>
                    @if ($listing->is_mileage_verified)
                        <i class='fi-alert-circle fs-sm text-primary ms-2' data-bs-toggle='tooltip'
                           title='{{ __('Verified by seller') }}'></i>
                    @endif
                </li>
                <li class="mb-2"><strong>{{ __('Body Type') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->type?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('Drivetrain') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->drivetype?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('Engine') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->engine_label }}</span></li>
                <li class="mb-2"><strong>{{ __('Transmission') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->transmission?->name }}</span></li>
            </ul>
        </div>
        <div class="col-sm-6 col-md-12 col-lg-6">
            <ul class="list-unstyled">
                <li class="mb-2"><strong>{{ __('Manufacturing Year') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->year }}</span></li>
                <li class="mb-2"><strong>{{ __('Fuel Type') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->fueltype?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('City MPG') }}:</strong>
                    <span class="opacity-70 ms-1">{{ Number::abbreviate($listing->city_mpg ?? 0) }}</span>
                    @if ($listing->is_city_mpg_verified)
                        <i class='fi-alert-circle fs-sm text-primary ms-2' data-bs-toggle='tooltip'
                           title='{{ __('Verified by seller') }}'></i>
                    @endif
                </li>
                <li class="mb-2"><strong>{{ __('Highway MPG') }}:</strong><span
                        class="opacity-70 ms-1">{{ Number::abbreviate($listing->highway_mpg ?? 0) }}</span>
                    @if ($listing->is_highway_mpg_verified)
                        <i class='fi-alert-circle fs-sm text-primary ms-2' data-bs-toggle='tooltip'
                           title='{{ __('Verified by seller') }}'></i>
                    @endif
                </li>
                <li class="mb-2"><strong>{{ __('Exterior Color') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->exteriorcolor?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('Interior Color') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->interiorcolor?->name }}</span></li>
                <li class="mb-2"><strong>{{ __('VIN') }}:</strong><span
                        class="opacity-70 ms-1">{{ $listing->vin }}</span></li>
            </ul>
        </div>
    </div>
</div>
{{apply_filters( 'section_after_specifications_listing_show', null )}}
