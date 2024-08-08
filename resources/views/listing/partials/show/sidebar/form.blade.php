<div class="card card-light card-body mb-4">
    <div class="text-light mb-2">{{ $listing->listedby?->name }}</div>
    <a class="d-flex align-items-center text-decoration-none mb-3"
       href="{{ route('listing.vendor', $listing->user) }}">
        <img loading="lazy" class="rounded-circle" src="{{ $listing->user->profile_photo_url }}" width="48"
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
                <i class="fi-phone me-2"></i> {{__('(***) *** **** – reveal')}}
            </button>
            <br>
        @endif
        <x-follow-button :user="$listing->user" />
        <a class="btn btn-primary btn-lg collapsed" href="#send-mail" data-bs-toggle="collapse"
           aria-expanded="false">
            <i class="fi-chat-left me-2"></i>{{ __('Send message') }}
        </a>
        {{apply_filters( 'section_after_vendor_listing_show', null )}}
        <div class="collapse" id="send-mail" style="">
            <form class="needs-validation pt-2 pb-4 mb-3" action="{{ route('consult.submit') }}"
                  method="POST">
                @csrf
                <input type="hidden" name="receiver" value="{{ $listing->user->id }}">
                <input type="hidden" name="listing" value="{{ $listing->id }}">
                @guest
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
                @endguest
                <div class="input-group mb-3">
                    <input name="booking_date" class="form-control form-control-light date-picker rounded pe-5 @error('booking_date') is-invalid @enderror" type="text" placeholder="{{__('Choose date and time')}}" data-datepicker-options='{"enableTime": true, "altInput": true, "altFormat": "F j, Y H:i", "dateFormat": "Y-m-d H:i"}'>
                    @error('booking_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <i class="fi-calendar position-absolute top-50 end-0 translate-middle-y me-3"></i>
                </div>
                <div class="mb-3">
                                        <textarea name="message" class="form-control form-control-light @error('message') is-invalid @enderror"
                                                  rows="4" placeholder="{{ __('Message*') }}" required=""></textarea>
                    @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-outline-primary" type="submit"><i
                        class="fi-send me-2"></i>{{ __('Send') }}</button>
            </form>
        </div>
    </div>
</div>
