@php
    $condition = \App\Models\Condition::select('id', 'name')->get();
    $makes = \App\Models\Make::select('id', 'name')->has('listings')->get();
    $types = \App\Models\Type::select('id', 'name')->get();
    $fuels = \App\Models\FuelType::select('id', 'name')->get();
@endphp
<section class="bg-position-top-center bg-repeat-0 pt-5"
    style="
          background-image: url({{ asset('theme/img/hero-bg.png') }});
          background-size: 1920px 630px;
        ">
    <div class="container pt-5">
        <div class="row pt-lg-4 pt-xl-5">
            <div class="col-lg-4 col-md-5 pt-3 pt-md-4 pt-lg-5">
                <h1 class="display-4 text-light pb-2 mb-4 me-md-n5">
                    {!! $data['title'] !!}
                </h1>
                <p class="fs-lg text-light opacity-70">
                    {!! $data['description'] !!}
                </p>
            </div>
            @if ($img = $data['image'])
                <div class="col-lg-8 col-md-7 pt-md-5">
                    <img class="d-block mt-4 ms-auto" src="{{ Storage::url($img) }}" width="800"
                        alt="{{ $data['title'] }}" />
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-4 mt-sm-3 mt-lg-n3 pb-5 mb-md-4">
        <ul class="nav nav-tabs nav-tabs-light mb-4">
            @foreach($condition as $c)
                <li class="nav-item"><a data-condition="{{$c->id}}" class="nav-link change-condition" href="javascript:;">{{$c->name}}</a></li>
            @endforeach
        </ul>
        <!-- Form group-->
        <form class="form-group form-group-light d-block" action="{{ route('listing.index') }}">
            <input type="hidden" name="condition">
            <div class="row g-0 ms-lg-n2">
                <div class="col-lg-2">
                    <div class="input-group border-end-lg border-light"><span
                            class="input-group-text text-muted ps-2 ps-sm-3"><i class="fi-search"></i></span>
                        <input class="form-control" type="text" name="keywords" placeholder="{{__('Keywords...')}}">
                    </div>
                </div>
                <hr class="hr-light d-lg-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown border-end-sm border-light" data-bs-toggle="select">
                        <button id="btnDropdownSelect" class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi-list me-2"></i><span class="dropdown-toggle-label">{{ __('Make') }}</span>
                        </button>
                        <input id="selectedMake" type="hidden" name="make">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                            @foreach ($makes as $make)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$make->name}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-sm-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown border-end-md border-light" data-bs-toggle="select">
                        <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-list me-2"></i><span
                                class="dropdown-toggle-label">{{{__('Fuel Type')}}}</span></button>
                        <input type="hidden" name="fuel">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                               @foreach ($fuels as $fuel)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$fuel->name}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-md-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown border-end-sm border-light" data-bs-toggle="select">
                        <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-car fs-lg me-2"></i><span
                                class="dropdown-toggle-label">{{__('Body type')}}</span></button>
                        <input type="hidden" name="type">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                         @foreach ($types as $type)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$type->name}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-sm-none my-2">
                <div class="col-lg-2">
                    <div class="input-group border-end-lg border-light"><span
                            class="input-group-text text-muted ps-2 ps-sm-3"><i class="fi-map-pin"></i></span>
                        <input id="autocomplete" class="form-control" type="text" name="location" placeholder="{{__('Location')}}">
                        <div id="map"></div>
                    </div>
                </div>
                <hr class="hr-light d-lg-none my-2">
                <div class="col-lg-2">
                    <button class="btn btn-primary w-100" type="submit">{{__('Search')}}</button>
                </div>
            </div>
        </form>
    </div>
</section>
@push('js-libs')
    <script>
        const conditions = document.querySelectorAll('.change-condition');
        conditions.forEach((condition) => {
            condition.addEventListener('click', (event) => {
                conditions.forEach((cond) => cond.classList.remove('active'));
                event.target.classList.add('active');
                document.querySelector('[name=condition]').value = event.target.getAttribute('data-condition');
            })
        })
    </script>
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
                input.value = place.name;

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
                    place.name);
                infowindow.open(map, marker);
            });
        }
    </script>
@endpush
