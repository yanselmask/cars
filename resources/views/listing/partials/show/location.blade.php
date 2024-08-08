@if ($listing->location)
    <section class="container mb-5 pb-lg-5" id="map-location">
        <div class="interactive-map rounded-3"
             data-map-options-json="{{request()->fullUrlWithQuery(['marker' => true])}}"
             style="height: 500px;"></div>
    </section>
@endif
{{apply_filters( 'section_after_location_listing_show', null )}}
