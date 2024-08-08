<section class="container mt-5 pb-lg-5" id="map-location">
    <div class="interactive-map rounded-3"
         data-map-options="{
    &quot;mapLayer&quot;: &quot;https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key={{ config('listing.map_api_key') }}&quot;,
    &quot;coordinates&quot;: [{{ $data['lat'] }}, {{ $data['long'] }}],
    &quot;zoom&quot;: 10,
    &quot;markers&quot;: [
        {
            &quot;coordinates&quot;: [{{ $data['lat'] }}, {{ $data['long'] }}],
            &quot;popup&quot;: &quot;&lt;div class='p-3'&gt;&lt;h6&gt;{{ $data['title'] }}&lt;/h6&gt;&lt;p class='fs-sm pt-1 mt-n3 mb-0'&gt;{{ $data['description'] }}&lt;/p&gt;&lt;/div&gt;&quot;,
            &quot;iconUrl&quot;: &quot;{{ asset('theme/img/marker-icon.png') }}&quot;
        }
    ]
}" style="height: 500px;"></div>
</section>
@push('css-libs')
    <link rel="stylesheet" media="screen" href="{{ asset('theme/css/leaflet.css') }}" />
@endpush
@push('js-libs')
    <script src="{{ asset('theme/js/leaflet.js') }}"></script>
@endpush
