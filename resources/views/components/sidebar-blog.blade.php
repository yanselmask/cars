<aside class="col-lg-4">
    <div class="offcanvas-lg offcanvas-end bg-dark" id="blog-sidebar">
        <div class="offcanvas-header bg-transparent border-bottom border-light">
            <h2 class="h5 text-light mb-0">{{ __('Sidebar') }}</h2>
            <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"
                data-bs-target="#blog-sidebar"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Search-->
            <form action="{{ route('blog.index') }}">
                <div class="position-relative mb-4">
                    <input class="form-control form-control-light" name="q" type="text"
                        placeholder="{{ __('Search...') }}"><i
                        class="fi-search position-absolute top-50 end-0 translate-middle-y text-light opacity-70 me-3"></i>
                </div>
            </form>
            @if ($post->user)
                <!-- Author widget-->
                <div class="card card-flush bg-transparent border-light mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start pt-3 pt-lg-0">
                            <img loading="lazy" class="rounded-circle" src="{{ $post->user->profile_photo_url }}" width="80"
                                alt="{{ $post->user->full_name }}">
                            <div class="ps-3">
                                <h3 class="h5 text-light mb-2">{{ $post->user->full_name }}</h3>
                                <p class="fs-sm text-light opacity-70">
                                    {{ __('Chief Editor at :site', ['site' => gs('site_name') ?? config('app.name')]) }}</p>
                                <div class="d-flex">
                                    @if (site_social('facebook'))
                                        <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle me-2"
                                            href="{{ site_social('facebook') }}">
                                            <i class="fi-facebook"></i>
                                        </a>
                                    @endif
                                    @if (site_social('x_twitter'))
                                        <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle me-2"
                                            href="{{ site_social('x_twitter') }}">
                                            <i class="fi-twitter"></i>
                                        </a>
                                    @endif
                                    @if (site_social('linkedin'))
                                        <a class="btn btn-icon btn-translucent-light btn-xs rounded-circle me-2"
                                            href="{{ site_social('linkedin') }}">
                                            <i class="fi-linkedin"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($related->count() > 0)
                <!-- Recent posts widget-->
                <div class="card card-flush bg-transparent border-light mb-4">
                    <div class="card-body">
                        <h3 class="h5 text-light pt-3 pt-lg-0">{{ __('Recent Posts') }}</h3>
                        @foreach ($related as $rt)
                            <div class="d-flex align-items-start border-bottom border-light pb-3 mb-3">
                                <a class="flex-shrink-0" href="#">
                                    <img loading="lazy" class="rounded-3" src="{{ $rt->thumb_image }}" width="80"
                                        alt="{{ $rt->name }}">
                                </a>
                                <div class="ps-3">
                                    @if ($rt->category)
                                        <a class="fs-xs text-uppercase text-primary text-decoration-none"
                                            href="{{ route('blog.index', ['category' => $rt->category->id]) }}">{{ $rt->category->name }}</a>
                                    @endif
                                    <h4 class="fs-base text-light pt-1 mb-2">
                                        <a class="nav-link" href="{{ route('blog.show', $rt) }}">
                                            {{ $rt->name }}
                                        </a>
                                    </h4>
                                    <div class="d-flex fs-xs text-light opacity-70">
                                        <span class="me-2 pe-1"><i
                                                class="fi-calendar-alt opacity-70 mt-n1 me-1 align-middle"></i>{{ $rt->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- Subscription form-->
            <div class="card card-flush bg-transparent border-light mb-4">
                <div class="card-body">
                    <h3 class="h5 text-light pt-3 pt-lg-0 pb-1 mb-2">{{ __('Subscribe to our newsletter') }}</h3>
                    <p class="fs-sm text-light opacity-70">
                        {{ __('We will send you hottest news as soon as they
                                                                                                are posted in the picked category.') }}
                    </p>
                    <form class="form-group form-group-light w-100">
                        <div class="input-group input-group-sm"><span class="input-group-text"> <i
                                    class="fi-mail"></i></span>
                            <input id="newsletterbgemail" class="form-control" type="text"
                                placeholder="{{ __('Your email') }}">
                        </div>
                        <button id="newsletterbgbtnst" class="btn btn-primary btn-sm"
                            type="button">{{ __('Subscribe') }}</button>
                    </form>
                    <span id="successaddedsrbg" class="text-success d-none"></span>
                </div>
            </div>
        </div>
    </div>
</aside>

@push('js-libs')
    <script>
        const email = document.getElementById('newsletterbgemail');
        const btn = document.getElementById('newsletterbgbtnst');
        const successaddedsr = document.getElementById('successaddedsrbg');
        btn.addEventListener('click', () => {
            if (email.value != '') {
                subscribesr();
            }
        });

        const subscribesr = async () => {
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
                    successaddedsr.classList.remove('d-none')
                    successaddedsr.classList.remove('text-danger')
                    successaddedsr.classList.add('text-success');
                    successaddedsr.textContent = response.success;

                    setTimeout(() => {
                        successaddedsr.classList.add('d-none')
                    }, 5000);
                } else {
                    successaddedsr.classList.remove('d-none')
                    successaddedsr.classList.remove('text-success');
                    successaddedsr.classList.add('text-danger');
                    successaddedsr.textContent = 'Error';

                    setTimeout(() => {
                        successaddedsr.classList.add('d-none')
                    }, 3000);

                }
            } catch (error) {
                console.log(`Error: ${error}`)
            }
        }
    </script>
@endpush
