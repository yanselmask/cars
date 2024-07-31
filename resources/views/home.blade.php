<x-app-layout>
    @push('seo')
        {!! seo()->for($page) !!}
    @endpush
    @push('js-libs')
            <script src="{{ asset('theme/js/jarallax.min.js') }}"></script>
            <script src="{{ asset('theme/js/rellax.min.js') }}"></script>
        @endpush

    @if($page)
    <x-section :page="$page" />
    @endif
</x-app-layout>
