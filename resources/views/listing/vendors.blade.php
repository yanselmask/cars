<x-app-layout>
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row py-md-1">
            <!-- Filers sidebar (Offcanvas on mobile)-->
            <div class="col-lg-3 pe-xl-4">
                <div class="offcanvas-lg offcanvas-start bg-dark" id="filters-sidebar-vendors">
                    <div class="offcanvas-header bg-transparent d-flex d-lg-none align-items-center">
                        <h2 class="h5 text-light mb-0">{{ __('Filters') }}</h2>
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"
                            data-bs-target="#filters-sidebar-vendors"></button>
                    </div>
                    <div class="offcanvas-body py-lg-4">
                        <div class="pb-4 mb-2">
                            <h3 class="h6 text-light">{{__('Location')}}</h3>
                            <select class="form-select form-select-light mb-2" id="city">
                                <option value="">{{__('Any location')}}</option>
                                @foreach ($locations as $location)
                                <option @selected(request()->query('city') == $location->address) value="{{$location->address}}">{{$location->address}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Catalog grid view-->
            <div class="col-lg-9">
                <!-- Breadcrumb-->
                <x-breadcrumb active="{{ __('Vendors') }}" :routes="[
                    [
                        'name' => __('Home'),
                        'link' => route('home'),
                    ],
                ]" />
                <!-- Page title-->
                <div class="d-flex align-items-center justify-content-between pb-4 mb-2">
                    <h1 class="text-light me-3 mb-0">{{ __('Vendors') }}</h1>
                    <div class="text-light">
                        <i class="fi-car fs-lg me-2"></i>
                        <span
                            class="align-middle">{{ trans_choice('{1} :qty vendor|[2,*] :qty vendors', $vendors->total(), ['qty' => $vendors->total()]) }}</span>
                    </div>
                </div>
                <div class="row">
                    @foreach ($vendors as $vendor)
                        <!-- Complex options via external local .json file -->
                        <!-- Content overlay on hover -->
                    <div class="col-sm-4 mb-3">
                        <!-- Carousel inside card -->
                        <div class="card shadow-sm card-hover border-0 card-light">
                            <div class="tns-carousel-wrapper card-img-top card-img-hover">
                                <a href="{{route('listing.vendor', $vendor)}}" class="img-overlay"></a>
                                <div class="tns-carousel-inner">
                                    <img src="{{$vendor->profile_photo_url}}" alt="{{$vendor->name}}">
                                </div>
                            </div>
                            <div class="card-body position-relative pb-3">
{{--                                <div class="mb-1 fs-xs text-uppercase text-primary">For sale</div>--}}
                                <h3 class="h6 mb-2 fs-base text-light">
                                    <a href="{{route('listing.vendor', $vendor)}}" class="nav-link stretched-link">{{$vendor->name}}</a>
                                </h3>
                                <p class="mb-2 fs-sm text-muted">{{$vendor->address ?? __('It has no location')}}</p>
                                <div class="fw-bold">
                                    <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>
                                    {{currency_format($vendor->listings->avg('price'))}} ({{__('Average')}})
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">
                                <span class="d-inline-block mx-1 px-2 fs-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Available cars')}}">
                                  {{$vendor->listings_count}}
                                  <i class="fi-car ms-1 mt-n1 fs-lg text-muted"></i>
                                </span>
                                <span class="d-inline-block mx-1 px-2 fs-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Certified cars')}}">
                                   {{$vendor->certified_count}}
                                  <i class="fi-award ms-1 mt-n1 fs-lg text-muted"></i>
                                </span>
                                <span class="d-inline-block mx-1 px-2 fs-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Featured cars')}}">
                                   {{$vendor->featured_count}}
                                  <i class="fi-check-circle ms-1 mt-n1 fs-lg text-muted"></i>
                                </span>
                            </div>
                        </div>
                    </div>
{{--                        <div class="col-md-6 mb-3">--}}
{{--                            <!-- No image + Contextual dropdown menu -->--}}
{{--                            <div class="card card-light card-hover">--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="d-flex justify-content-between align-items-start mb-2">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <img loading="lazy" class="me-2" src="{{ $vendor->profile_photo_url }}" width="24"--}}
{{--                                                alt="{{ $vendor->fullname }}">--}}
{{--                                            <span class="fs-sm text-light px-1">{{ $vendor->fullname }}</span>--}}
{{--                                            @if ($vendor->verified)--}}
{{--                                                <span--}}
{{--                                                    class="badge bg-faded-success rounded-pill fs-sm ms-2">{{ __('Verified') }}</span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <h3 class="h6 card-title pt-1 mb-3">--}}
{{--                                        <a href="{{ route('listing.vendor', $vendor) }}"--}}
{{--                                            class="text-nav text-light stretched-link text-decoration-none">{{ $vendor->fullname }}</a>--}}
{{--                                    </h3>--}}
{{--                                    @if ($vendor->address || $vendor->listings_count)--}}
{{--                                        <div class="fs-sm">--}}
{{--                                            @if ($vendor->address)--}}
{{--                                                <span class="text-nowrap me-3">--}}
{{--                                                    <i class="fi-map-pin text-muted me-1"> </i>--}}
{{--                                                    {{ $vendor->address }}--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                            @if ($vendor->listings_count)--}}
{{--                                                <span class="text-nowrap me-3">--}}
{{--                                                    <i class="fi-car fs-base text-muted me-1"></i>--}}
{{--                                                    {{ $vendor->listings_count }}--}}
{{--                                                </span>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- Examples of .json files with map options you can find in dist/json folder -->
                    @endforeach
                    {{ $vendors->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    @once
    @push('css-libs')
        <link rel="stylesheet" media="screen" href="{{ asset('theme/css/leaflet.css') }}" />
    @endpush
    @push('js-libs')
        <script src="{{ asset('theme/js/leaflet.js') }}"></script>
         <script>
            const city = document.getElementById('city');

            city.addEventListener('change', (event) => {
                const selectedValue = event.target.value;
                const url = new URL(window.location);
                url.searchParams.set('city', selectedValue);
                url.searchParams.delete('page');
                window.location.href = url.toString();
            })
        </script>
    @endpush
    @endonce
</x-app-layout>
