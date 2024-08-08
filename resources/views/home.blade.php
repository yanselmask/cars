<x-app-layout>
    <!-- JS -->
    @include('partials.home.js')
    @if($page)
    <!-- Seo -->
        @include('partials.home.seo')
        <!-- Section -->
    <x-section :page="$page" />
    @endif
</x-app-layout>
