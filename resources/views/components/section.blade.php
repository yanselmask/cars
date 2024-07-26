@if ($page->sections->count() > 0)
    @foreach ($page->sections as $section)
        @switch($section->data_values[0]['type'])
            @case('about_us')
                @include('sections.about_us', ['data' => $section->data_values[0]['data']])
            @break

            @case('list_grid_card')
                @include('sections.list_grid_card', ['data' => $section->data_values[0]['data']])
            @break

            @case('our_story')
                @include('sections.our_story', ['data' => $section->data_values[0]['data']])
            @break

            @case('card_image')
                @include('sections.card_image', ['data' => $section->data_values[0]['data']])
            @break

            @case('partners')
                @include('sections.partners', ['data' => $section->data_values[0]['data']])
            @break

            @case('faq')
                @include('sections.faq', ['data' => $section->data_values[0]['data']])
            @break

            @case('blog')
                @include('sections.blog', ['data' => $section->data_values[0]['data']])
            @break

            @case('app_mobile')
                @include('sections.app_mobile', ['data' => $section->data_values[0]['data']])
            @break

            @case('brands')
                @include('sections.brands', ['data' => $section->data_values[0]['data']])
            @break

            @case('map')
                @include('sections.map', ['data' => $section->data_values[0]['data']])
            @break

            @case('contact_us')
                @include('sections.contact_us', ['data' => $section->data_values[0]['data']])
            @break

             @case('homepage_hero')
                @include('sections.homepage_hero', ['data' => $section->data_values[0]['data']])
            @break

             @case('types')
                @include('sections.types', ['data' => $section->data_values[0]['data']])
            @break

            @case('offers')
                @include('sections.offers', ['data' => $section->data_values[0]['data']])
            @break

            @case('features')
                @include('sections.features', ['data' => $section->data_values[0]['data']])
            @break

            @case('listing')
                @include('sections.listing', ['data' => $section->data_values[0]['data']])
            @break

            @case('carousel')
                @include('sections.carousel', ['data' => $section->data_values[0]['data']])
            @break

             @case('plans')
                @include('sections.plans', ['data' => $section->data_values[0]['data']])
            @break

            @default
        @endswitch
    @endforeach
@endif
