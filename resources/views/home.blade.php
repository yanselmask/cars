<x-app-layout>
    @push('js-libs')
            <script src="{{ asset('theme/js/jarallax.min.js') }}"></script>
            <script src="{{ asset('theme/js/rellax.min.js') }}"></script>
        @endpush

    @if($page)
            @push('seo')
                {!! seo()->for($page) !!}
            @endpush
    <x-section :page="$page" />
    @endif
</x-app-layout>
