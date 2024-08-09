<div class="card card-body p-4 card-light mb-4">
    <div class="row row-cols-2 row-cols-sm-4 gx-3 gx-xl-4 gy-4">
        @if ($listing->is_certified)
            <div class="col text-light text-center">
                <div class="d-table bg-dark rounded-3 mx-auto p-3"><img loading="lazy"
                                                                        src="{{ asset('theme/img/check.svg') }}" width="48" alt="Icon">
                </div>
                <div class="fs-sm pt-2 mt-1">
                    {{ __('Checked and Certified by :site', ['site' => config('app.name')]) }}
                </div>
            </div>
        @endif
        @if ($listing->is_single_owner)
            <div class="col text-light text-center">
                <div class="d-table bg-dark rounded-3 mx-auto p-3">
                    <img loading="lazy" src="{{ asset('theme/img/steering-wheel.svg') }}" width="48"
                         alt="{{__('Icon')}}">
                </div>
                <div class="fs-sm pt-2 mt-1">{{ __('Single Owner') }}</div>
            </div>
        @endif
        @if ($listing->is_well_equipped)
            <div class="col text-light text-center">
                <div class="d-table bg-dark rounded-3 mx-auto p-3"><img loading="lazy"
                                                                        src="{{ asset('theme/img/driving-test.svg') }}" width="48"
                                                                        alt="{{__('Icon')}}"></div>
                <div class="fs-sm pt-2 mt-1">{{ __('Well-Equipped') }}</div>
            </div>
        @endif
        @if ($listing->no_accident)
            <div class="col text-light text-center">
                <div class="d-table bg-dark rounded-3 mx-auto p-3"><img loading="lazy"
                                                                        src="{{ asset('theme/img/accident.svg') }}" width="48"
                                                                        alt="{{__('Icon')}}"></div>
                <div class="fs-sm pt-2 mt-1">{{ __('No Accident / Damage Reported') }}</div>
            </div>
        @endif
        {{apply_filters( 'inside_box_badges', null )}}
    </div>
</div>
