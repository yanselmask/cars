@once
    @push('css-libs')
        <link rel="stylesheet" media="screen" href="{{ asset('theme/css/lightgallery-bundle.min.css') }}" />
        <link rel="stylesheet" media="screen" href="{{ asset('theme/css/leaflet.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
        <script>
            const email = document.getElementById('newsletterltemail');
            const btn = document.getElementById('newsletterltbtnst');
            const successaddedlt = document.getElementById('successaddedlt');
            const reveal = document.getElementById('reveal');
            let revelated = false;
            reveal?.addEventListener('click', (event) => {
                if(!revelated)
                {
                    revelated = true;
                    event.target.innerHTML = `
                <i class="fi-phone me-2"></i> {{ $listing->user->phone_number }}
                    `;
                }
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
@endonce
