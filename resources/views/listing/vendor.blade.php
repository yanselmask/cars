<x-app-layout>
    <div class="container pt-5 pb-lg-4 my-5">
        <!-- Breadcrumb-->
        <x-breadcrumb active="Vendor" :routes="[
            [
                'name' => __('Home'),
                'link' => route('home'),
            ],
            [
                'name' => __('Sellers'),
                'link' => route('listing.vendors'),
            ],
        ]" />
        <div class="row">
            <!-- Content-->
            <div class="col-lg-8 order-lg-2 mb-5">
                <div class="d-sm-flex align-items-center justify-content-between pb-4 mb-sm-2">
                    <h1 class="h3 text-light mb-sm-0 me-sm-3">{{ __('Available car offers') }}</h1>
                    <div class="d-flex align-items-center">
                        <label class="fs-sm text-light me-2 pe-1 text-nowrap" for="sorting">
                            <i class="fi-arrows-sort mt-n1 me-2"></i>{{ __('Sort by') }}:</label>
                        <select class="form-select form-select-light form-select-sm" id="sorting">
                            <option value="desc" @selected(request()->query('sort') == 'desc')>{{ __('Newest') }}</option>
                            <option value="asc" @selected(request()->query('sort') == 'asc')>{{ __('Oldest') }}</option>
                            <option value="price_low" @selected(request()->query('sort') == 'price_low')>{{ __('Price: Low - High') }}
                            </option>
                            <option value="price_hight" @selected(request()->query('sort') == 'price_hight')>{{ __('Price: Hight - Low') }}
                            </option>
                            <option value="popular" @selected(request()->query('sort') == 'popular')>{{ __('Popular') }}</option>
                        </select>
                    </div>
                </div>
                @foreach ($listings as $listing)
                    <!-- Item-->
                    <x-listing-list :listing="$listing" />
                @endforeach

                <!-- Pagination-->
                {{ $listings->links() }}
            </div>
            <!-- Sidebar-->
            <aside class="col-lg-4 order-lg-1 pe-xl-4 mb-5">
                <div class="d-flex align-items-start mb-4">
                    <img loading="lazy" class="rounded-circle" src="{{ $user->profile_photo_url }}" width="72"
                        alt="{{ $user->full_name }}">
                    <div class="ps-2">
                        <h2 class="h4 text-light mb-1">
                            {{ $user->full_name }}
                            @if ($user->verified)
                                <button type="button" class="btn btn-success btn-xs pb-1 px-2" data-bs-container="body"
                                    data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover"
                                    data-bs-content="{{ __('This seller is verified by :site', ['site' => site_name()]) }}"><i
                                        class="fi-check-circle"></i></button>
                            @endif
                        </h2>
                        @if ($user->address)
                            <p class="d-flex align-items-center text-light opacity-70">
                                <i class="fi-map-pin me-1"></i><span>{{ $user->address }}</span>
                            </p>
                        @endif
                        @if ($user->whatsapp_link || $user->instagram_link || $user->facebook_link)
                            <div class="d-flex">
                                @if ($user->whatsapp_link)
                                    <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle me-2"
                                        href="{{ $user->whatsapp_link }}">
                                        <i class="fi-whatsapp"></i>
                                    </a>
                                @endif
                                @if ($user->instagram_link)
                                    <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle me-2"
                                        href="{{ $user->instagram_link }}">
                                        <i class="fi-instagram"></i>
                                    </a>
                                @endif
                                @if ($user->facebook_link)
                                    <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle"
                                        href="{{ $user->facebook_link }}">
                                        <i class="fi-facebook"></i>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <ul class="list-unstyled text-light py-2 mb-3">
                    <li><strong>{{ __('Available car offers') }}: </strong><span
                            class="opacity-70">{{ $user->listings->count() }}</span></li>
                    <li><strong>{{ __('Cars certified') }}: </strong><span
                            class="opacity-70">{{ $user->listingsCertified->count() }}</span></li>
                    {{apply_filters( 'list_vendor_show', null )}}
                </ul>
                @if ($user->phone_number)
                    <button id="reveal" class="btn btn-outline-light btn-lg px-4 mb-4" type="button">
                        <i class="fi-phone me-2"></i> (***) *** **** – reveal
                    </button>
                @endif
                <form class="needs-validation pt-2 pb-4 mb-3" action="{{ route('consult.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="receiver" value="{{ $user->id }}">
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
                            class="form-control form-control-light @error('email') is-invalid @enderror" type="email"
                            placeholder="{{ __('Email*') }}" required="">
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
                        <textarea name="message" class="form-control form-control-light @error('message') is-invalid @enderror" rows="4"
                            placeholder="{{ __('Message*') }}" required=""></textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit"><i
                            class="fi-send me-2"></i>{{ __('Send message') }}</button>
                </form>
                {{apply_filters( 'section_after_form_vendor_listings', null )}}
            </aside>
        </div>
    </div>
    @once
    @push('js-libs')
        <script>
            const reveal = document.getElementById('reveal');
            const sorting = document.getElementById('sorting');
            let revelated = false;

            reveal?.addEventListener('click', (event) => {
              if(!revelated)
              {
                  revelated = true;
                  event.target.innerHTML = `
                <i class="fi-phone me-2"></i> {{ $user->phone_number }}
                  `;
              }
            })

            sorting.addEventListener('change', (event) => {
                const selectedValue = event.target.value;
                const url = new URL(window.location);
                url.searchParams.set('sort', selectedValue);
                url.searchParams.delete('page');
                window.location.href = url.toString();
            })
        </script>
    @endpush
    @endonce
</x-app-layout>
