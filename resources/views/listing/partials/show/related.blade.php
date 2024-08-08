@if ($related->count() > 0)
    <h2 class="h3 text-light pt-5 pb-3 mt-md-4">{{ __('You may be interested in') }}</h2>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-carousel-light">
        <div class="tns-carousel-inner"
             data-carousel-options="{&quot;loop&quot;: false,&quot;items&quot;: 3, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;gutter&quot;: 24}}}">
            @foreach ($related as $listing)
                <div>
                    <x-listing-grid :listing="$listing" />
                </div>
            @endforeach
        </div>
    </div>
@endif
{{apply_filters( 'section_after_related_listing_show', null )}}
