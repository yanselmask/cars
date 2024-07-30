<x-app-layout>
    @push('seo')
        @if(!$listing->seo->image)
          <meta property="og:image" content="{{ $listing->media[0]->getUrl('single') }}">
        @endif
        {!! seo()->for($listing) !!}
    @endpush
    <div class="container mt-5 mb-md-4 py-5">
        <!-- Breadcrumb-->
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
                'name' => $listing->make->name,
                'link' => route('listing.index', ['make' => $listing->make_id]),
            ],
            [
                'name' => $listing->makemodel->name,
                'link' => route('listing.index', ['make' => $listing->make_id, 'model' => $listing->makemodel_id]),
            ],
        ]" />
        <!-- Title + Sharing-->
        <div class="d-sm-flex align-items-end align-items-md-center justify-content-between position-relative mb-4"
            style="z-index: 1025;">
            <div class="me-3">
                <h1 class="h2 text-light mb-md-0">{{ $listing->name }}</h1>
                <div class="d-md-none">
                    <div class="d-flex align-items-center mb-3">
                        <div class="h3 mb-0 text-light">{{ $listing->pricing }}</div>
                        <div class="text-nowrap ps-3">
                            <span class="badge bg-info fs-base me-2">{{ $listing->condition->name }}</span>
                            @if ($listing->is_certified)
                                <span class="badge bg-success fs-base me-2" data-bs-toggle="popover"
                                    data-bs-placement="bottom" data-bs-trigger="hover" data-bs-html="true"
                                    data-bs-content="&lt;div class=&quot;d-flex&quot;&gt;&lt;i class=&quot;fi-award mt-1 me-2&quot;&gt;&lt;/i&gt;&lt;div&gt;{{ __('This car is checked and') }}&lt;br&gt;{{ __('certified by :site', ['site' => config('app.name')]) }}.&lt;/div&gt;&lt;/div&gt;">{{ __('Certified') }}</span>
                            @endif
                            @if ($listing->is_featured)
                                <span class="badge bg-danger fs-base me-2">{{ __('Featured') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center text-light mb-2">
                        <div class="text-nowrap border-end border-light pe-3 me-3">
                            <i class="fi-dashboard fs-lg opacity-70 me-2"></i>
                            <span class="align-middle">{{ $listing->miles }}</span>
                        </div>
                        <div class="text-nowrap">
                            <i class="fi-map-pin fs-lg opacity-70 me-2"></i>
                            <span class="align-middle">{{ $listing->city_zip }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-nowrap pt-3 pt-sm-0">
                <button data-listing="{{ $listing->id }}"
                    class="btn-favorite btn btn-icon btn-xs rounded-circle mb-sm-2 @auth {{ auth()->user()->hasFavorited($listing->id)? 'btn-danger': 'btn-translucent-light' }} @else btn-translucent-light @endauth"
                    type="button" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="@auth {{ auth()->user()->hasFavorited($listing->id)? __('Remove from favorite'): __('Add to favorite') }} @else {{ __('Add to favorite') }} @endauth">
                    <i class="fi-heart"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <!-- Gallery-->
                <div class="tns-carousel-wrapper">
                    <div class="tns-slides-count text-light"><i class="fi-image fs-lg me-2"></i>
                        <div class="ps-1"><span class="tns-current-slide fs-5 fw-bold"></span><span
                                class="fs-5 fw-bold">/</span><span class="tns-total-slides fs-5 fw-bold"></span></div>
                    </div>
                    <div class="tns-carousel-inner"
                        data-carousel-options="{&quot;navAsThumbnails&quot;: true, &quot;navContainer&quot;: &quot;#thumbnails&quot;, &quot;gutter&quot;: 12, &quot;responsive&quot;: {&quot;0&quot;:{&quot;controls&quot;: false},&quot;500&quot;:{&quot;controls&quot;: true}}}">
                        @foreach ($listing->media as $photo)
                            <div><img class="rounded-3" src="{{ $photo->getUrl('single') }}"
                                    alt="{{ __('Image') }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <ul class="tns-thumbnails" id="thumbnails">
                    @foreach ($listing->media as $photo)
                        <li class="tns-thumbnail"><img src="{{ $photo->getUrl('thumb') }}"
                                alt="{{ __('Thumbnail') }}">
                        </li>
                    @endforeach
                    @if ($listing->video_link)
                        <li class="tns-thumbnail">
                            <a class="d-flex flex-column align-items-center justify-content-center w-100 h-100 bg-faded-light rounded text-light text-decoration-none"
                                href="{{ $listing->video_link }}" data-bs-toggle="lightbox" data-video="true">
                                <i class="fi-play-circle fs-5"></i>
                                <span class="opacity-70 mt-1">{{ __('Play video') }}</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <!-- Specs-->
                <div class="py-3 mb-3">
                    <h2 class="h4 text-light mb-4">{{ __('Specifications') }}</h2>
                    <div class="row text-light">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>{{ __('Make') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->make->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('Model') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->makemodel->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('Mileage') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->miles }}</span>
                                    @if ($listing->is_mileage_verified)
                                        <i class='fi-alert-circle fs-sm text-primary ms-2' data-bs-toggle='tooltip'
                                           title='{{ __('Verified by seller') }}'></i>
                                    @endif
                                </li>
                                <li class="mb-2"><strong>{{ __('Body Type') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->type->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('Drivetrain') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->drivetype->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('Engine') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->engine_label }}</span></li>
                                <li class="mb-2"><strong>{{ __('Transmission') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->transmission->name }}</span></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>{{ __('Manufacturing Year') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->year }}</span></li>
                                <li class="mb-2"><strong>{{ __('Fuel Type') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->fueltype->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('City MPG') }}:</strong>
                                    <span class="opacity-70 ms-1">{{ number_format($listing->city_mpg) }}</span>
                                    @if ($listing->is_city_mpg_verified)
                                        <i class='fi-alert-circle fs-sm text-primary ms-2' data-bs-toggle='tooltip'
                                            title='{{ __('Verified by seller') }}'></i>
                                    @endif
                                </li>
                                <li class="mb-2"><strong>{{ __('Highway MPG') }}:</strong><span
                                        class="opacity-70 ms-1">{{ number_format($listing->highway_mpg) }}</span>
                                    @if ($listing->is_highway_mpg_verified)
                                        <i class='fi-alert-circle fs-sm text-primary ms-2' data-bs-toggle='tooltip'
                                            title='{{ __('Verified by seller') }}'></i>
                                    @endif
                                </li>
                                <li class="mb-2"><strong>{{ __('Exterior Color') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->exteriorcolor->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('Interior Color') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->interiorcolor->name }}</span></li>
                                <li class="mb-2"><strong>{{ __('VIN') }}:</strong><span
                                        class="opacity-70 ms-1">{{ $listing->vin }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if ($listing->is_certified || $listing->is_single_owner || $listing->is_well_equipped || $listing->no_accident)
                    <!-- Card with icon boxes-->
                    <div class="card card-body p-4 card-light mb-4">
                        <div class="row row-cols-2 row-cols-sm-4 gx-3 gx-xl-4 gy-4">
                            @if ($listing->is_certified)
                                <div class="col text-light text-center">
                                    <div class="d-table bg-dark rounded-3 mx-auto p-3"><img
                                            src="{{ asset('theme/img/check.svg') }}" width="48" alt="Icon">
                                    </div>
                                    <div class="fs-sm pt-2 mt-1">
                                        {{ __('Checked and Certified by :site', ['site' => config('app.name')]) }}
                                    </div>
                                </div>
                            @endif
                            @if ($listing->is_single_owner)
                                <div class="col text-light text-center">
                                    <div class="d-table bg-dark rounded-3 mx-auto p-3">
                                        <img src="{{ asset('theme/img/steering-wheel.svg') }}" width="48"
                                            alt="Icon">
                                    </div>
                                    <div class="fs-sm pt-2 mt-1">{{ __('Single Owner') }}</div>
                                </div>
                            @endif
                            @if ($listing->is_well_equipped)
                                <div class="col text-light text-center">
                                    <div class="d-table bg-dark rounded-3 mx-auto p-3"><img
                                            src="{{ asset('theme/img/driving-test.svg') }}" width="48"
                                            alt="Icon"></div>
                                    <div class="fs-sm pt-2 mt-1">{{ __('Well-Equipped') }}</div>
                                </div>
                            @endif
                            @if ($listing->no_accident)
                                <div class="col text-light text-center">
                                    <div class="d-table bg-dark rounded-3 mx-auto p-3"><img
                                            src="{{ asset('theme/img/accident.svg') }}" width="48"
                                            alt="Icon"></div>
                                    <div class="fs-sm pt-2 mt-1">{{ __('No Accident / Damage Reported') }}</div>
                                </div>
                            @endif
                                {{apply_filters( 'inside_box_badges', null )}}
                        </div>
                    </div>
                @endif
                <!-- Features-->
                <h2 class="h4 text-light pt-3 mb-4">{{ __('Features') }}</h2>
                <div class="accordion accordion-light" id="features">
                    @foreach (\App\Enums\FeatureType::cases() as $k => $featureType)
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
                    @endforeach
                </div>
                <!-- Description-->
                <div class="pb-4 mb-3">
                    <h2 class="h4 text-light pt-4 mt-3">{{ __('Seller\'s Description') }}</h2>
                    <p class="text-light opacity-70 mb-1">
                        {{$listing->description}}
                    </p>
                    <div class="collapse" id="seeMoreDescription">
                         <x-markdown class="text-light opacity-70 mb-1" id="markdownOutput">
                            {{$listing->content}}
                         </x-markdown>
                    </div>
                    <a class="collapse-label collapsed" href="#seeMoreDescription" data-bs-toggle="collapse"
                        data-bs-label-collapsed="{{__('Show more')}}" data-bs-label-expanded="{{__('Show less')}}" role="button"
                        aria-expanded="false" aria-controls="seeMoreDescription"></a>
                </div>
                @if ($listing->location)
                    <section class="container mb-5 pb-lg-5" id="map-location">
                        <div class="interactive-map rounded-3"
                            data-map-options="{
    &quot;mapLayer&quot;: &quot;https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key={{ config('listing.map_api_key') }}&quot;,
    &quot;coordinates&quot;: [{{ $listing->location['lat'] }}, {{ $listing->location['lng'] }}],
    &quot;zoom&quot;: 10,
    &quot;markers&quot;: [
        {
            &quot;coordinates&quot;: [{{ $listing->location['lat'] }}, {{ $listing->location['lng'] }}],
            &quot;popup&quot;: &quot;&lt;div class='p-3'&gt;&lt;h6&gt;{{ $listing->name }}&lt;/h6&gt;&lt;p class='fs-sm pt-1 mt-n3 mb-0'&gt;{{ $listing->user->full_name }}&lt;/p&gt;&lt;/div&gt;&quot;,
            &quot;iconUrl&quot;: &quot;{{ asset('theme/img/marker-icon.png') }}&quot;
        }
    ]
}"
                            style="height: 500px;"></div>
                    </section>
                @endif
                {{apply_filters( 'section_after_location_listing_show', null )}}
                <!-- Post meta-->
                <div class="d-flex flex-wrap border-top border-light fs-sm text-light pt-4 pb-5 pb-md-2">
                    <div class="border-end border-light pe-3 me-3">
                        <span class="opacity-70">{{ __('Published') }}:
                            <strong>{{ $listing->date }}</strong></span>
                    </div>
                    <div class="border-end border-light pe-3 me-3">
                        <span class="opacity-70">{{ __('Ad number') }}: <strong>{{ $listing->id }}</strong></span>
                    </div>
                    <div class="opacity-70">{{ __('Views') }}: <strong>{{ $listing->views }}</strong></div>
                </div>
            </div>
            <!-- Sidebar-->
            <div class="col-md-5 pt-5 pt-md-0" style="margin-top: -6rem;">
                <div class="sticky-top pt-5">
                    <div class="d-none d-md-block pt-5">
                        <div class="d-flex mb-4">
                            <span class="badge bg-info fs-base me-2">{{ $listing->condition->name }}</span>
                            @if ($listing->is_certified)
                                <span class="badge bg-success fs-base me-2" data-bs-toggle="popover"
                                    data-bs-placement="top" data-bs-trigger="hover" data-bs-html="true"
                                    data-bs-content="&lt;div class=&quot;d-flex&quot;&gt;&lt;i class=&quot;fi-award mt-1 me-2&quot;&gt;&lt;/i&gt;&lt;div&gt;{{ __('This car is checked and') }}&lt;br&gt;{{ __('certified by :site', ['site' => config('app.name')]) }}.&lt;/div&gt;&lt;/div&gt;">{{ __('Certified') }}</span>
                            @endif
                            @if ($listing->is_featured)
                                <span class="badge bg-danger fs-base me-2">{{ __('Featured') }}</span>
                            @endif
                        </div>
                        <div class="h3 text-light">{{ $listing->pricing }}</div>
                        <div class="d-flex align-items-center text-light pb-4 mb-2">
                            <div class="text-nowrap border-end border-light pe-3 me-3">
                                <i class="fi-dashboard fs-lg opacity-70 me-2"></i>
                                <span class="align-middle">{{ $listing->miles }}</span>
                            </div>
                            <div class="text-nowrap"><i class="fi-map-pin fs-lg opacity-70 me-2"></i><span
                                    class="align-middle">{{ $listing->city_zip }}</span></div>
                        </div>
                    </div>
                    <div class="card card-light card-body mb-4">
                        <div class="text-light mb-2">{{ $listing->listedby->name }}</div>
                        <a class="d-flex align-items-center text-decoration-none mb-3"
                            href="{{ route('listing.vendor', $listing->user) }}">
                            <img class="rounded-circle" src="{{ $listing->user->profile_photo_url }}" width="48"
                                alt="{{ $listing->user->name }}">
                            <div class="ps-2">
                                <h5 class="text-light mb-0">{{ $listing->user?->fullname }}</h5>
                            </div>
                        </a>
                        <a class="text-light"
                            href="{{ route('listing.vendor', $listing->user) }}">{{ __('Other ads by this seller') }}</a>
                        <div class="pt-4 mt-2">
                            @if ($listing->user->phone_number)
                                <button id="reveal" class="btn btn-outline-light btn-lg px-4 mb-3" type="button">
                                    <i class="fi-phone me-2"></i> (***) *** **** – reveal
                                </button>
                                <br>
                            @endif
                            <a class="btn btn-primary btn-lg collapsed" href="#send-mail" data-bs-toggle="collapse"
                                aria-expanded="false">
                                <i class="fi-chat-left me-2"></i>{{ __('Send message') }}
                            </a>
                            <div class="collapse" id="send-mail" style="">
                                <form class="needs-validation pt-2 pb-4 mb-3" action="{{ route('consult.submit') }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="receiver" value="{{ $listing->user->id }}">
                                    <input type="hidden" name="listing" value="{{ $listing->id }}">
                                    <div class="mb-3">
                                        <input name="fullname"
                                            class="form-control form-control-light @error('fullname') is-invalid @enderror"
                                            type="text" placeholder="{{ __('Fullname') }}" required="">
                                        @error('fullname')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input name="email"
                                            class="form-control form-control-light @error('email') is-invalid @enderror"
                                            type="email" placeholder="{{ __('Email*') }}" required="">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input name="phone"
                                            class="form-control form-control-light bg-image-0 @error('phone') is-invalid @enderror"
                                            type="text" placeholder="{{ __('Phone') }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="message" class="form-control form-control-light @error('message') is-invalid @enderror"
                                            rows="4" placeholder="{{ __('Message*') }}" required=""></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary btn-lg" type="submit"><i
                                            class="fi-send me-2"></i>{{ __('Send message') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body bg-transparent border-light">
                        <h5 class="text-light">
                            {{ __('Email me price drops and new listings for these search results') }}:</h5>
                        <span id="successaddedlt" class="text-success d-none mb-2"></span>
                        <form class="form-group form-group-light mb-3">
                            <div class="input-group"><span class="input-group-text"> <i class="fi-mail"></i></span>
                                <input name="email" id="newsletterltemail" class="form-control" type="email"
                                    placeholder="{{ __('Your email') }}" required>
                            </div>
                            <button id="newsletterltbtnst" class="btn btn-primary"
                                type="button">{{ __('Subscribe') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{apply_filters( 'section_before_related_listing_show', null )}}
        <!-- Related posts (Carousel)-->
        @if ($related->count() > 0)
            <h2 class="h3 text-light pt-5 pb-3 mt-md-4">{{ __('You may be interested in') }}</h2>
            <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-carousel-light">
                <div class="tns-carousel-inner"
                    data-carousel-options="{&quot;items&quot;: 3, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;gutter&quot;: 24}}}">
                    @foreach ($related as $listing)
                        <div>
                            <x-listing-grid :listing="$listing" />
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @push('css-libs')
        <link rel="stylesheet" media="screen" href="{{ asset('theme/css/lightgallery-bundle.min.css') }}" />
        <link rel="stylesheet" media="screen" href="{{ asset('theme/css/leaflet.css') }}" />
        <style>
            #markdownOutput h1,
            #markdownOutput h2,
            #markdownOutput h3,
            #markdownOutput h4,
            #markdownOutput h5,
            #markdownOutput h6{
                color: #FFFFFF;
            }
        </style>
    @endpush
    @push('js-libs')
        <script src="{{ asset('theme/js/lightgallery.min.js') }}"></script>
        <script src="{{ asset('theme/js/lg-video.min.js') }}"></script>
        <script src="{{ asset('theme/js/leaflet.js') }}"></script>
        <script>
            const email = document.getElementById('newsletterltemail');
            const btn = document.getElementById('newsletterltbtnst');
            const successaddedlt = document.getElementById('successaddedlt');
            const reveal = document.getElementById('reveal');
            reveal?.addEventListener('click', (event) => {
                event.target.innerHTML = `
                <i class="fi-phone me-2"></i> {{ $listing->user->phone_number }}
                `;
            })
            btn.addEventListener('click', () => {
                if (email.value != '') {
                    subscribelt();
                }
            });

            const subscribelt = async () => {
                try {
                    const request = await fetch(@js(route('newsletter.add')), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            email: email.value
                        })
                    });
                    const response = await request.json();

                    if (response.success) {
                        email.value = '';
                        successaddedlt.classList.remove('d-none')
                        successaddedlt.classList.remove('text-danger')
                        successaddedlt.classList.add('text-success');
                        successaddedlt.textContent = response.success;

                        setTimeout(() => {
                            successaddedlt.classList.add('d-none')
                        }, 5000);
                    } else {
                        successaddedlt.classList.remove('d-none')
                        successaddedlt.classList.remove('text-success');
                        successaddedlt.classList.add('text-danger');
                        successaddedlt.textContent = 'Error';

                        setTimeout(() => {
                            successaddedlt.classList.add('d-none')
                        }, 3000);

                    }
                } catch (error) {
                    console.log(`Error: ${error}`)
                }
            }
        </script>
    @endpush
</x-app-layout>
