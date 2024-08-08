<h2 class="h4 text-light pt-3 mb-4">{{ __('Features') }}</h2>
<div class="accordion accordion-light" id="features">
    @foreach (\App\Enums\FeatureType::cases() as $k => $featureType)
        @if($listing->features->where('type', $featureType)->count())
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading-{{ $k }}">
                    <button class="accordion-button @if (config('listing.listing_feature_type_showed') !== $featureType) collapsed @endif"
                            type="button" data-bs-toggle="collapse" data-bs-target="#feature-{{ $k }}"
                            aria-expanded="@if (config('listing.listing_feature_type_showed') == $featureType) true @else false @endif"
                            aria-controls="feature-{{ $k }}">{{ $featureType->getLabelCapitalize() }}</button>
                </h2>
                <div class="accordion-collapse collapse @if (config('listing.listing_feature_type_showed') == $featureType) show @endif"
                     id="feature-{{ $k }}" aria-labelledby="heading-{{ $k }}"
                     data-bs-parent="#features">
                    <div class="accordion-body fs-sm text-light opacity-70">
                        <div class="row">
                            @foreach ($listing->features->where('type', $featureType)->chunk(6) as $chunk)
                                <div class="col-sm-6">
                                    <ul>
                                        @foreach($chunk as $item)
                                            <li>{{$item->name}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
