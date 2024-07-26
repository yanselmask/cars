<x-app-layout>
        @push('seo')
        {!! seo()->for($page) !!}
    @endpush
    <div class="container my-5 pt-5 pb-lg-5">
        <!-- Breadcrumb-->
        <x-breadcrumb :active="$page->name" :routes="[
            [
                'name' => 'Home',
                'link' => route('home'),
            ],
        ]" />
        <x-section :page="$page" />
    </div>
</x-app-layout>
