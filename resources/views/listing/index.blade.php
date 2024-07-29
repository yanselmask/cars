<x-app-layout>
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row py-md-1">
            <!-- Filers sidebar (Offcanvas on mobile)-->
            <x-sidebar-listing />
            <!-- Catalog list view-->
            <div class="col-lg-9">
                <!-- Breadcrumb-->
                <x-breadcrumb :routes="[
                    [
                        'name' => 'Home',
                        'link' => route('home'),
                    ],
                ]" active="Listing" class="mb-3 pt-md-2 pt-lg-4" />
                <!-- Page title-->
                <div class="d-flex align-items-center justify-content-between pb-4 mb-2">
                    <h1 class="text-light me-3 mb-0">{{ __('Search listing') }}</h1>
                    <div class="text-light">
                        <i class="fi-car fs-lg me-2"></i>
                        <span class="align-middle">{{ __(':qty offers', ['qty' => $listings->total()]) }}</span>
                    </div>
                </div>
                <!-- Sorting + View-->
                <div class="d-sm-flex align-items-center justify-content-between pb-4 mb-2">
                    <div class="d-flex align-items-center me-sm-4">
                        <label class="fs-sm text-light me-2 pe-1 text-nowrap" for="sort">
                            <i class="fi-arrows-sort mt-n1 me-2"></i>{{ __('Sort by') }}:
                        </label>
                        <select id="sort" class="form-select form-select-light form-select-sm me-sm-4">
                            <option value="desc" @selected(request()->query('sort') == 'desc')>{{ __('Newest') }}</option>
                            <option value="asc" @selected(request()->query('sort') == 'asc')>{{ __('Oldest') }}</option>
                            <option value="price_low" @selected(request()->query('sort') == 'price_low')>{{ __('Price: Low - High') }}
                            </option>
                            <option value="price_hight" @selected(request()->query('sort') == 'price_hight')>{{ __('Price: Hight - Low') }}
                            </option>
                             <option value="popular" @selected(request()->query('sort') == 'popular')>{{ __('Popular') }}</option>
                        </select>
                        <div class="d-none d-md-block border-end border-light" style="height: 1.25rem;"></div>
                        <div class="d-none d-sm-block fw-bold text-light opacity-70 text-nowrap ps-md-4">
                            <i class="fi-switch-horizontal me-2"></i>
                            <span class="align-middle">{{ __('Compare (:qty)', ['qty' => auth()?->user()?->comparedListings()->count() ?? 0 ]) }}</span>
                        </div>
                    </div>
                    <div class="d-none d-sm-flex">
                        <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'list' || !request()->query('view') && config('listing.listing_result_view') == 'list' ? 'active' : '' }}"
                            href="{{ route('listing.index', array_merge(request()->query(), ['view' => 'list'])) }}"
                            data-bs-toggle="tooltip" title="{{ __('List view') }}">
                            <i class="fi-list"></i>
                        </a>
                        <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'grid' || !request()->query('view') && config('listing.listing_result_view') == 'grid' ? 'active' : '' }}"
                            href="{{ route('listing.index', array_merge(request()->query(), ['view' => 'grid'])) }}"
                            data-bs-toggle="tooltip" title="{{ __('Grid view') }}">
                            <i class="fi-grid"></i>
                        </a>
                    </div>
                </div>
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
            </div>
        </div>
    </div>

        <!-- Filters sidebar toggle button (mobile)-->
    <button class="btn btn-primary btn-sm w-100 rounded-0 fixed-bottom d-lg-none" type="button"
        data-bs-toggle="offcanvas" data-bs-target="#filters-sidebar">
        <i
            class="fi-filter me-2"></i>{{ __('Filters') }}</button>

    @push('css-libs')
        <link rel="stylesheet" media="screen" href="{{ asset('theme/vendor/nouislider/dist/nouislider.min.css') }}" />
        @vite(['resources/js/app.js'])
    @endpush

    @push('js-libs')
        <script src="{{ asset('theme/vendor/nouislider/dist/nouislider.min.js') }}"></script>
        <script async
                src="https://maps.googleapis.com/maps/api/js?key={{config('filament-google-maps.key')}}&loading=async&libraries=places&callback=initMap">
        </script>
        <script>
            var map;
            var marker;

            function initMap() {
                // Inicializa el mapa
                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: -34.397, lng: 150.644 },
                    zoom: 8
                });

                // Crear el autocompletado
                var input = document.getElementById('autocomplete');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                // Infowindow para el marcador
                var infowindow = new google.maps.InfoWindow();
                marker = new google.maps.Marker({
                    map: map
                });

                // Evento de lugar cambiado
                autocomplete.addListener('place_changed', function() {
                    infowindow.close();
                    var place = autocomplete.getPlace();
                    const url = new URL(window.location);
                    url.searchParams.delete('page');
                    url.searchParams.set('location', place.name);
                    window.location.href = url.toString();

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // Si el lugar tiene una geometría, entonces presenta en el mapa
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);  // Un zoom más alto para ubicaciones detalladas
                    }

                    // Colocar el marcador en el lugar
                    marker.setPlace({
                        placeId: place.place_id,
                        location: place.geometry.location
                    });
                    marker.setVisible(true);

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                        'Place ID: ' + place.place_id + '<br>' +
                        place.formatted_address);
                    infowindow.open(map, marker);
                });
            }
        </script>
    @endpush
</x-app-layout>
