<x-app-layout title="{{ 'Compares - ' . gs('site_name') }}">
    <section class="container mt-5 py-5">
          <!-- Breadcrumb-->
        <x-breadcrumb active="{{__('Compares')}}" :routes="[
            [
                'name' => 'Home',
                'link' => route('home'),
            ],
        ]" />
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 text-light mb- mb-sm-0">{{ __('Compares') }}</h2>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4 col-md-3"></div>
            @foreach ($listings as $listing)
                <div class="col-sm-4 col-md-3">
                    <x-listing-grid :listing="$listing" />
                </div>
            @endforeach
        </div>
        <div class="row">
            <!-- Dark table -->
            <!-- Actionalbe list group -->
            <div class="col-sm-4 col-md-3">
                <div class="list-group">
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Title') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Price') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Condition') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Type') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Make') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Model') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Year') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Drive Type') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Transmission') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Fuel Type') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Mileage') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Engine Size') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Cylinders') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Interior Color') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Exterior Color') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Doors') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('VIN') }}</a>
                    <a href="javascript:;"
                        class="list-group-item list-group-item-action list-group-item-light">{{ __('Location') }}</a>
                    @foreach ($features as $feature)
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-light">{{ $feature->name }}</a>
                    @endforeach
                </div>
            </div>
            @foreach ($listings as $listing)
                <div class="col-sm-4 col-md-3">
                    <div class="list-group">
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->pricing }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->condition->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->type->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->make->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->makemodel->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->year }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->drivetype->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->transmission->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->fueltype->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->mileage }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->engine_cc }}L</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->cylinders }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->interiorcolor->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->exteriorcolor->name }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->doors }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->vin }}</a>
                        <a href="javascript:;"
                            class="list-group-item list-group-item-action list-group-item-dark">{{ $listing->city }}</a>
                        @foreach ($features as $feature)
                            <a href="javascript:;"
                                class="list-group-item list-group-item-action bg-dark {{ $listing->features->contains($feature->id) ? 'text-success' : 'text-danger' }}">{{ $listing->features->contains($feature->id) ? __('Yes') : __('No') }}</a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
