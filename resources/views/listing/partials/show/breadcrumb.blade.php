<x-breadcrumb :active="$listing->name" :routes="[
            [
                'name' => __('Home'),
                'link' => route('home'),
            ],
            [
                'name' => __('Search'),
                'link' => route('listing.index'),
            ],
            [
                'name' => $listing->make?->name,
                'link' => route('listing.index', ['make' => $listing->make_id]),
            ],
            [
                'name' => $listing->makemodel?->name,
                'link' => route('listing.index', ['make' => $listing->make_id, 'model' => $listing->makemodel_id]),
            ],
        ]" />
