<footer class="footer bg-faded-light">
    <div class="border-bottom border-light py-4">
        <div class="container d-sm-flex align-items-center justify-content-between">
            @if(site_logo())
            <a class="d-inline-block" href="{{ route('home') }}">
                <img src="{{ site_logo() }}" width="116" alt="{{ gs('site_name') }}">
            </a>
            @endif
            <div class="d-flex pt-3 pt-sm-0">
                <div class="dropdown ms-n3">
                    <button class="btn btn-light btn-link btn-sm dropdown-toggle fw-normal py-2" type="button"
                        data-bs-toggle="dropdown"><i class="fi-globe me-2"></i>{{language()->getName()}}</button>
                    <div class="dropdown-menu dropdown-menu-dark w-100">
                         @foreach (language()->allowed() as $code => $name)
                            <a class="dropdown-item" href="{{ language()->back($code) }}">{{ $name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-4 pb-3 pt-lg-5 pb-lg-4">
        <div class="row pt-2 pt-lg-0">
            @if (config('listing.footer_widgets.show_widget_1'))
                <div class="col-lg-3 pb-2 mb-4">
                    <h3 class="h5 text-light mb-2">{{ __('Subscribe to our newsletter') }}</h3>
                    <p class="fs-sm text-light opacity-70">{{ __('Don’t miss any relevant offers!') }}</p>
                    <form class="form-group form-group-light w-100">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text"> <i class="fi-mail"></i></span>
                            <input name="email" id="newsletterftemail" class="form-control" type="email"
                                placeholder="{{ __('Your email') }}">
                        </div>
                        <button id="newsletterftbtnst" class="btn btn-primary btn-icon btn-sm" type="button"><i
                                class="fi-send"></i></button>
                    </form>
                    <span id="successadded" class="text-success d-none"></span>
                </div>
            @endif
            @if (config('listing.footer_widgets.show_widget_2'))
                <div class="col-lg-2 col-md-3 col-sm-6 offset-xl-1 mb-2 mb-sm-4">
                    <x-menu menu="footer_menu_1" />
                </div>
            @endif
            @if (config('listing.footer_widgets.show_widget_3'))
                <div class="col-lg-2 col-md-3 col-sm-6 mb-2 mb-sm-4">
                    <x-menu menu="footer_menu_2" />
                </div>
            @endif
            @if (config('listing.footer_widgets.show_widget_4'))
                <div class="col-lg-2 col-md-3 col-sm-6 mb-2 mb-sm-4">
                    <x-menu menu="footer_menu_3" />
                </div>
            @endif
            @if (config('listing.footer_widgets.show_widget_5'))
                <div class="col-xl-2 col-lg-3 col-sm-6 col-md-3 mb-2 mb-sm-4">
                    @if (gs('support_phone'))
                        <a class="d-flex align-items-center text-decoration-none mb-2"
                            href="tel:{{ gs('support_phone') }}">
                            <i class="fi-device-mobile me-2"></i>
                            <span class="text-light">{{ gs('support_phone') }}</span>
                        </a>
                    @endif
                    @if (gs('support_email'))
                        <a class="d-flex align-items-center text-decoration-none mb-2"
                            href="mailto:{{ gs('support_email') }}">
                            <i class="fi-mail me-2"></i>
                            <span class="text-light">{{ gs('support_email') }}</span>
                        </a>
                    @endif
                    <div class="d-flex flex-wrap pt-4">
                        @if (site_social('facebook'))
                            <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 me-2"
                                href="{{ site_social('facebook') }}">
                                <i class="fi-facebook"></i>
                            </a>
                        @endif
                        @if (site_social('x_twitter'))
                            <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 me-2"
                                href="{{ site_social('x_twitter') }}">
                                <i class="fi-twitter"></i>
                            </a>
                        @endif
                        @if (site_social('telegram'))
                            <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 me-2"
                                href="{{ site_social('telegram') }}">
                                <i class="fi-telegram"></i>
                            </a>
                        @endif
                        @if (site_social('messenger'))
                            <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2"
                                href="{{ site_social('messenger') }}">
                                <i class="fi-messenger"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container d-lg-flex align-items-center justify-content-between fs-sm pb-3">
        <x-menu menu="footer_bottom" />
        <p class="text-center text-lg-start order-lg-1 mb-lg-0">{!! copyright() !!}</p>
    </div>
</footer>


@push('js-libs')
    <script>
        const emailft = document.getElementById('newsletterftemail');
        const btnft = document.getElementById('newsletterftbtnst');
        const successadded = document.getElementById('successadded');
        btnft.addEventListener('click', () => {
            if (emailft.value != '') {
                subscribe();
            }
        });

        const subscribe = async () => {
            try {
                const request = await fetch(@js(route('newsletter.add')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        email: emailft.value
                    })
                });
                const response = await request.json();

                if (response.success) {
                    emailft.value = '';
                    successadded.classList.remove('d-none')
                    successadded.classList.remove('text-danger')
                    successadded.classList.add('text-success');
                    successadded.textContent = response.success;

                    setTimeout(() => {
                        successadded.classList.add('d-none')
                    }, 5000);
                } else {
                    successadded.classList.remove('d-none')
                    successadded.classList.remove('text-success');
                    successadded.classList.add('text-danger');
                    successadded.textContent = 'Error';

                    setTimeout(() => {
                        successadded.classList.add('d-none')
                    }, 3000);

                }
            } catch (error) {
                console.log(`Error: ${error}`)
            }
        }
    </script>
@endpush
