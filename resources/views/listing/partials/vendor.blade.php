@push('css-libs')
    <link rel="stylesheet" media="screen" href="{{ asset('theme/css/nouislider.min.css') }}" />
    @vite(['resources/js/app.js'])
@endpush
@push('js-libs')
    <script>
        const listings = document.querySelectorAll('.listing');
        if (document.readyState === "loading") {
            listings?.forEach((listing) => {
                listing.style.opacity = 0.4;
            })
            // Loading hasn't finished yet
            document.addEventListener("DOMContentLoaded", () => {
                listings?.forEach((listing) => {
                    listing.style.opacity = 1;
                })
            });
        }
    </script>
    <script src="{{ asset('theme/js/nouislider.min.js') }}"></script>
    <script async
            src="https://maps.googleapis.com/maps/api/js?key={{config('filament-google-maps.key')}}&loading=async&libraries=places&callback=initMap">
    </script>
    <script>
        let comparebtn = document.getElementById('to-compare');
        let compares = document.querySelectorAll('.compare-check');
        var map;
        var marker;

        if(compares.length == 0) comparebtn.style.cursor = 'auto';

        comparebtn.addEventListener('click',(event) => {
            if(compares.length == 0) return;
            event.target.classList.toggle('text-primary');
            compares?.forEach((item) => {
                item.classList.toggle('d-none');
            })
        })

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
