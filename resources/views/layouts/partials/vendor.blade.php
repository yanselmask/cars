@once
<x-notify />
<!-- Back to top button--><a class="btn-scroll-top" href="#top" data-scroll><span
        class="btn-scroll-top-tooltip text-muted fs-sm me-2">{{ __('Top') }}</span><i
        class="btn-scroll-top-icon fi-chevron-up"> </i></a>
<!-- Vendor scrits: js libraries and plugins-->
<script src="{{ asset('theme/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('theme/js/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/js/smooth-scroll.polyfills.min.js') }}"></script>
<script src="{{ asset('theme/js/tiny-slider.js') }}"></script>
<script>
    const listings = document.querySelectorAll('.listing');
    const placeholders = document.querySelectorAll('.placeholder-loading');
    if (document.readyState === "loading") {
        listings?.forEach((listing) => {
            listing.classList.add('d-none');
        });
        placeholders?.forEach((placeholder) => {
            placeholder.classList.remove('d-none');
        });
        // Loading hasn't finished yet
        document.addEventListener("DOMContentLoaded", () => {
            listings?.forEach((listing) => {
                listing.classList.remove('d-none');
            });
            placeholders?.forEach((placeholder) => {
                placeholder.classList.add('d-none');
            });
        });
    }
</script>
@if(config('listing.progress_bar'))
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <script>
        // Alternative to DOMContentLoaded event
        document.addEventListener("readystatechange", (event) => {
            if (event.target.readyState === "interactive") {
                NProgress.start()
            } else if (event.target.readyState === "complete") {
                NProgress.done()
            }
        });
    </script>
@endif
@stack('js-libs')
<script>
    const btns = document.querySelectorAll('.btn-favorite');
    const btnscompare = document.querySelectorAll('.btn-compare');
    if (btns) {
        btns.forEach((btn) => {
            btn.addEventListener('click', (event) => {
                togglePath(btn.getAttribute('data-listing'), @js(route('add.favorite.listing')),event,true)
            })
        })
    }

    if (btnscompare) {
        btnscompare.forEach((btn) => {
            btn.addEventListener('click', (event) => {
                togglePath(btn.getAttribute('data-listing'), @js(route('add.compare.listing')), event)
            })
        })
    }

    const togglePath = async (id, url,event, refresh = false) => {
        try {
            const request = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': @js(csrf_token()),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    listing: id
                })
            });
            const response = await request.json();

            if(response.type == 'compare' && response.code != 'limit')
            {
                document.querySelector('.compareCount')
                        .textContent =`Compare (${response.count})`;
            }
            if(response.type == 'compare' && response.code == 'limit' && event.target.checked)
            {
                event.target.checked = false;
                alert(@js(__('You reached the comparison limit, delete one.')));
            }

            if(refresh)
            {
                history.go(0);
            }

        } catch (error) {
            window.location.href = @js(config('app.url') . '/' . config('listing.vendor_path'))
        }
    }
</script>
<script>
    let btnsFollow = document.querySelectorAll('.follow-user');
    const follow = async (user, event) => {
        try {
            const req = await fetch(@js(route('toggleFollowUser')),{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': @js(csrf_token())
                },
                body: JSON.stringify({user: user})
            });
            const res = await req.json();
            if(req.status == 200 && res.type == 'follow')
            {
                event.target.innerText = @js(__('Following'));
                event.target.classList.remove('btn-info');
                event.target.classList.add('btn-success');
            }

            if(req.status == 200 && res.type == 'unfollow')
            {
                event.target.innerText = @js(__('Follow'));
                event.target.classList.remove('btn-success');
                event.target.classList.add('btn-info');
            }
        }catch(err){
            console.log(err);
        }
    }
    btnsFollow.forEach((btn) => {
        btn.addEventListener('click',(event) => {
            follow(event.target.getAttribute('data-user'),event)
        })
    })
</script>
<!-- Main theme script-->
<script src="{{ asset('theme/js/theme.min.js') }}"></script>
@stack('js-end')
@endonce
