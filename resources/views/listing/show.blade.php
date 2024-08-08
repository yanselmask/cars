<x-app-layout>
        <!-- Seo -->
        @include('listing.partials.show.seo')
    <div class="container mt-5 mb-md-4 py-5">
        <!-- Breadcrumb -->
        @include('listing.partials.show.breadcrumb')
        <!-- Title + Sharing -->
        @include('listing.partials.show.titlesharing')
        <!-- Content -->
        @include('listing.partials.show.content')
        <!-- Related posts (Carousel) -->
        @include('listing.partials.show.related')
    </div>
        <!-- Style & JS -->
        @include('listing.partials.show.style_js_vendor')
</x-app-layout>
