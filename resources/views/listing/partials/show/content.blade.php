<div class="row">
    <div class="col-md-7">
        <!-- Gallery-->
        @include('listing.partials.show.gallery')
        <!-- Specs-->
        @include('listing.partials.show.specs')
        <!-- Card with icon boxes Check -->
        @if ($listing->is_certified || $listing->is_single_owner || $listing->is_well_equipped || $listing->no_accident)
            <!-- Card with icon boxes-->
            @include('listing.partials.show.card')
        @endif
        <!-- Features-->
        @include('listing.partials.show.features')
        <!-- Description-->
        @include('listing.partials.show.description')
        @include('listing.partials.show.location')
        <!-- Post meta-->
        @include('listing.partials.show.postmeta')
    </div>
    <!-- Sidebar-->
    @include('listing.partials.show.sidebar.main')
</div>
{{apply_filters( 'section_before_related_listing_show', null )}}
