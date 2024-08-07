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
            btn.addEventListener('click', () => {
                togglePath(btn.getAttribute('data-listing'), @js(route('add.favorite.listing')))
            })
        })
    }

    if (btnscompare) {
        btnscompare.forEach((btn) => {
            btn.addEventListener('click', () => {
                togglePath(btn.getAttribute('data-listing'), @js(route('add.compare.listing')))
            })
        })
    }

    const togglePath = async (id, url) => {
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
            if (response.message) {
                location.reload();
            }
        } catch (error) {
            window.location.href = @js(config('app.url') . '/' . config('listing.vendor_path'))
        }
    }
</script>
<!-- Main theme script-->
<script src="{{ asset('theme/js/theme.min.js') }}"></script>
@stack('js-end')
@endonce
