<x-app-layout>
    @push('seo')
        {!! seo()->for($page) !!}
    @endpush

    @if($page)
    <x-section :page="$page" />
    @endif
</x-app-layout>
