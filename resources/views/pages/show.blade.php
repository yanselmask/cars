<x-app-layout>
        <!-- Seo -->
        @include('pages.partials.seo')
    <div class="container my-5 pt-5 pb-lg-5">
        <!-- Breadcrumb -->
        @include('pages.partials.breadcrumb')
        <x-section :page="$page" />
    </div>
</x-app-layout>
