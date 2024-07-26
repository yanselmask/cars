<section class="container my-5 pt-5 pb-lg-5">
    <div class="row gy-4">
        <div class="col-lg-4 col-md-6">
            <div class="mb-md-5 mb-4 pb-md-4">
                <h1 class="mb-md-4 text-light">{{ $data['title'] }}</h1>
                <p class="mb-0 fs-lg text-light opacity-70">
                    {{ $data['description'] }}
                </p>
            </div>
            @foreach ($data['list'] as $item)
                <div class="d-flex align-items-start mb-4 pb-md-3">
                    @if ($icon = $item['icon'])
                        <img class="me-3 flex-shrink-0" src="{{ Storage::url($icon) }}" width="32"
                            alt="{{ $item['title'] }}">
                    @endif
                    <div>
                        <h3 class="h6 mb-2 pb-1 text-light">{{ $item['title'] }}</h3>
                        <p class="mb-0 text-light"><span class="opacity-70">
                                {!! $item['description'] !!}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6 offset-lg-2">
            <!-- Contact form-->
            @if (session('flash'))
                <div class="alert alert-success">{{ session('flash') }}</div>
            @else
                <form class="needs-validation" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label text-light" for="c-name">{{ __('Full Name') }}</label>
                        <input name="fullname"
                            class="form-control form-control-lg form-control-light @error('fullname') is-invalid @enderror"
                            id="c-name" type="text" required>
                        @error('fullname')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-light" for="c-email">{{ __('Your Email') }}</label>
                        <input name="email"
                            class="form-control form-control-lg form-control-light @error('email') is-invalid @enderror"
                            id="c-email" type="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-light" for="c-subject">{{ __('Subject') }}</label>
                        <select name="subject"
                            class="form-select form-select-lg form-select-light @error('subject') is-invalid @enderror"
                            id="c-subject" required>
                            <option value="" selected disabled>{{ __('Choose subject') }}</option>
                            @foreach (config('listing.subjects_contact') as $subject)
                                <option value="{{ $subject }}">{{ $subject }}</option>
                            @endforeach
                        </select>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-light" for="c-message">{{ __('Message') }}</label>
                        <textarea name="message" class="form-control form-control-lg form-control-light @error('message') is-invalid @enderror"
                            id="c-message" rows="4" placeholder="{{ __('Leave your message') }}" required></textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pt-2">
                        <button class="btn btn-lg btn-primary w-sm-auto w-100"
                            type="submit">{{ __('Submit form') }}</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</section>
