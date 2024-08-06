<x-app-layout>
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row py-md-1">
            <!-- Filers sidebar (Offcanvas on mobile)-->
            <x-sidebar-listing />
            <!-- Catalog list view-->
            <div class="col-lg-9">
                <!-- Breadcrumb-->
                @include('listing.partials.breadcrumb')
                <!-- Page title-->
                @include('listing.partials.page-title')
                <!-- Sorting + View-->
                @include('listing.partials.sorting')
                <!-- Listing + View-->
                @include('listing.partials.listings')
            </div>
        </div>
    </div>
    <!-- Filters sidebar toggle button (mobile)-->
    @include('listing.partials.filters')
    @include('listing.partials.vendor')
</x-app-layout>
