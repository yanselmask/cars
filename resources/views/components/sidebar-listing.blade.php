  <div class="col-lg-3 pe-xl-4">
      <div class="offcanvas-lg offcanvas-start bg-dark" id="filters-sidebar">
          <div class="offcanvas-header bg-transparent d-flex d-lg-none align-items-center border-bottom border-light">
              <h2 class="h5 text-light mb-0">{{ __('Filters') }}</h2>
              <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"
                      data-bs-target="#filters-sidebar"></button>
          </div>
          @if (count(request()->query()) > 0)
          <div class="offcanvas-header bg-transparent d-lg-none pb-0">
                 <h2 class="h5 text-light mb-0">{{ __('Selection') }}</h2>
                 <a class="btn btn-link btn-light fw-normal fs-sm p-0" href="{{ route('listing.index') }}">
                     {{ __('Clear all') }}
                 </a>
          </div>
              <div class="offcanvas-header bg-transparent border-bottom border-light">
                  <ul class="nav nav-pills nav-pills-light fs-sm mx-0">
                      @foreach (request()->query() as $key => $value)
                          <li class="nav-item mb-2 me-2">
                              <button class="nav-link px-3 remove-param" type="button"
                                      data-key="{{ $key }}">{{ ucfirst($key) }} <i
                                      class="fi-x fs-xxs ms-2"></i></button>
                          </li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="offcanvas-header bg-transparent d-none d-lg-block border-bottom border-light pt-0 pt-lg-4 px-lg-0 mt-3 mt-lg-0">
              <h2 class="h5 text-light mb-3">{{ __('Condition') }}</h2>
              <ul class="nav nav-tabs nav-tabs-light mb-0">
                  @foreach ($condition as $c)
                      <li class="nav-item mb-3">
                          <a onclick="addLinkQuery(@js($c->id), 'condition')" class="nav-link @if (request()->query('condition') == $c->id || request()->query('condition') == $c->name) active @endif"
                             href="javascript:;">{{  $c->name }}
                          </a>
                      </li>
                  @endforeach
              </ul>
          </div>
          <div class="offcanvas-body py-lg-4" x-data="{more_filters: @js(count(request()->query()) > 5)}">
              @if (count(request()->query()) > 0)
              <div class="pb-3 mb-4 border-bottom border-light d-none d-lg-block">
                  <div class="d-flex align-items-center justify-content-between mb-3">
                      <h3 class="h6 text-light mb-0">{{ __('Selection') }}</h3>
                      <a class="btn btn-link btn-light fw-normal fs-sm p-0" href="{{ route('listing.index') }}">{{ __('Clear all') }}</a>
                  </div>
                  <ul class="nav nav-pills nav-pills-light flex-row fs-sm mx-0">
                      @foreach (request()->query() as $key => $value)
                          <li class="nav-item mb-2 me-2">
                              <button class="nav-link px-3 remove-param" type="button"
                                      data-key="{{ $key }}">{{ ucfirst($key) }} <i
                                      class="fi-x fs-xxs ms-2"></i></button>
                          </li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <div class="pb-4 mb-2 d-lg-none">
                  <h3 class="h6 text-light">{{ __('Condition') }}</h3>
                  <ul class="nav nav-tabs nav-tabs-light mb-0 d-flex flex-row ms-0">
                      @foreach ($condition as $c)
                          <li class="nav-item mb-3">
                              <a class="nav-link @if (request()->query('condition') == $c->id || request()->query('condition') == $c->name) active @endif"
                                 href="{{ request()->fullUrlWithQuery([
                                  'condition' => $c->id,
                              ]) }}">{{  $c->name }}
                              </a>
                          </li>
                      @endforeach
                  </ul>
              </div>
                  <div class="pb-4 mb-2">
                      <h3 class="h6 text-light">{{ __('Keywords') }}</h3>
                      <input type="text" placeholder="{{ __('Keywords...') }}" name="keywords"
                             class="form-control form-control-light " id="keywords"
                             value="{{ request()->query('keywords') }}">
                  </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Location') }}</h3>
                  <input value="{{request()->query('location')}}" class="form-control form-control-light" id="autocomplete" placeholder="{{__('Location')}}">
                  <div id="map"></div>
              </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Make & Model') }}</h3>
                  <select id="make" class="form-select form-select-light mb-2" id="make">
                      <option value="">{{ __('Any make') }}</option>
                      @foreach ($makes as $make)
                          <option value="{{ $make->id }}" @selected(request()->query('make') == $make->id || request()->query('make') == $make->name)>{{ $make->name }}
                          </option>
                      @endforeach
                  </select>
                  <select id="model" class="form-select form-select-light mb-1">
                      <option value="">{{ __('Any model') }}</option>
                      @foreach ($models as $model)
                          <option value="{{ $model->id }}" @selected(request()->query('model') == $model->id)>{{ $model->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
                  <div class="pb-4 mb-2">
                          <h3 class="h6 text-light">{{__('Price')}}</h3>
                          <div class="range-slider range-slider-light mb-3"
                               data-start-min="{{request()->query('min_price', config('listing.min_price'))}}"
                               data-start-max="{{request()->query('max_price', config('listing.max_price'))}}"
                               data-min="{{config('listing.min_price')}}"
                               data-max="{{config('listing.max_price')}}"
                               data-step="{{config('listing.step_price')}}">
                              <div class="range-slider-ui range-slider-price"></div>
                              <div class="d-flex align-items-center">
                                  <div class="w-50 pe-2">
                                      <div class="input-group">
                                          <span class="input-group-text fs-base form-control-light">{{currency()->find(config('currency.default'))?->symbol}}</span>
                                          <input id="minPrice" class="form-control form-control-light range-slider-value-min" type="text">
                                      </div>
                                  </div>
                                  <div class="text-muted">&mdash;</div>
                                  <div class="w-50 ps-2">
                                      <div class="input-group">
                                          <span class="input-group-text fs-base form-control-light">{{currency()->find(config('currency.default'))?->symbol}}</span>
                                          <input id="maxPrice" class="form-control form-control-light range-slider-value-max" type="text">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-check form-switch form-switch-light">
                              <input id="is_negotiated" name="is_negotiated" @checked(request()->query('is_negotiated'))
                              class="form-check-input" type="checkbox"
                                     value="{{ request()->query('is_negotiated') ? '' : true }}">
                              <label class="form-check-label fs-sm" for="is_negotiated">{{ __('Negotiated price') }}</label>
                          </div>
                  </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light pt-1">{{ __('Year') }}</h3>
                  <div class="range-slider range-slider-light mb-3"
                       data-start-min="{{request()->query('from_year', config('listing.years_from'))}}"
                       data-start-max="{{request()->query('to_year', config('listing.years_to'))}}"
                       data-min="{{config('listing.years_from')}}"
                       data-max="{{config('listing.years_to')}}"
                       data-step="{{config('listing.years_step')}}"
                       >
                      <div class="range-slider-ui range-slider-year"></div>
                      <div class="d-flex align-items-center">
                          <div class="w-50 pe-2">
                              <input id="from-year" class="form-control form-control-light range-slider-value-min" type="text">
                          </div>
                          <div class="text-muted">&mdash;</div>
                          <div class="w-50 ps-2">
                              <div class="input-group">
                                  <input id="to-year" class="form-control form-control-light range-slider-value-max" type="text">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
                  <div class="pb-4 mb-2">
                      <h3 class="h6 text-light pt-1">{{ __('Mileage') }}</h3>
                      <div class="range-slider range-slider-light mb-3"
                           data-start-min="{{request()->query('mileage_min', config('listing.mileage_min'))}}"
                           data-start-max="{{request()->query('mileage_max', config('listing.mileage_max'))}}"
                           data-min="{{config('listing.mileage_min')}}"
                           data-max="{{config('listing.mileage_max')}}"
                           data-step="{{config('listing.mileage_step')}}">
                          <div class="range-slider-ui range-slider-mileage"></div>
                          <div class="d-flex align-items-center">
                              <div class="w-50 pe-2">
                                  <input id="mileage-min" class="form-control form-control-light range-slider-value-min" type="text">
                              </div>
                              <div class="text-muted">&mdash;</div>
                              <div class="w-50 ps-2">
                                  <div class="input-group">
                                      <input id="mileage-max" class="form-control form-control-light range-slider-value-max" type="text">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="pb-4 mb-2 text-center">
                      <button class="btn btn-link btn-light fw-normal fs-sm p-0" x-on:click="more_filters = !more_filters">
                          <span x-show="!more_filters">{{__('More Filters')}}</span>
                          <span x-show="more_filters">{{__('Less Filters')}}</span>
                      </button>
                  </div>
                  <div x-show="more_filters" x-transition>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Transmission') }}</h3>
                  <select id="transmission" class="form-select form-select-light mb-2">
                      <option value="">{{ __('Select transmission') }}</option>
                      @foreach ($transmissions as $transmission)
                          <option value="{{ $transmission->id }}" @selected(request()->query('transmission') == $transmission->id)>
                              {{ $transmission->name }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Body Type') }}</h3>
                  <select id="type" class="form-select form-select-light mb-2">
                      <option value="">{{ __('Select type') }}</option>
                      @foreach ($types as $type)
                          <option value="{{ $type->id }}" @selected(request()->query('type') == $type->id || request()->query('type') == $type->name)>{{ $type->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Drivetrain') }}</h3>
                  <select id="drive" class="form-select form-select-light mb-2">
                      <option value="">{{ __('Select drivetrain') }}</option>
                      @foreach ($drives as $drive)
                          <option value="{{ $drive->id }}" @selected(request()->query('drive') == $drive->id)>{{ $drive->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Cylinders') }}</h3>
                  <select id="cylinder" class="form-select form-select-light mb-2">
                      <option value="">{{ __('Select cylinder') }}</option>
                      @for ($i = 1; $i <= config('listing.cylinders_qty'); $i++)
                          <option value="{{ $i }}" @selected(request()->query('cylinder') == $i)>
                              {{ $i }}
                          </option>
                      @endfor
                  </select>
              </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Fuel Type') }}</h3>
                  <select id="fuel" class="form-select form-select-light mb-2">
                      <option value="">{{ __('Select fuel type') }}</option>
                      @foreach ($fuels as $fuel)
                          <option value="{{ $fuel->id }}" @selected(request()->query('fuel') == $fuel->id)>
                              {{ $fuel->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
                      <div class="pb-4 mb-2">
                          <h3 class="h6 text-light pt-1">{{__('Color')}}</h3>
                          <div class="d-flex align-items-center">
                              <select id="exterior_color" class="form-select form-select-light w-100">
                                  <option value="">{{ __('Exterior') }}</option>
                                  @foreach ($colors as $exterior)
                                      <option value="{{ $exterior->id }}" @selected(request()->query('exterior_color') == $exterior->id)>
                                          {{ $exterior->name }}
                                      </option>
                                  @endforeach
                              </select>
                              <div class="mx-2">&mdash;</div>
                              <select id="interior_color" class="form-select form-select-light w-100">
                                  <option value="">{{ __('Interior') }}</option>
                                  @foreach ($colors as $interior)
                                      <option value="{{ $interior->id }}" @selected(request()->query('interior_color') == $interior->id)>
                                          {{ $interior->name }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Seller') }}</h3>
                  <select id="seller" class="form-select form-select-light mb-2">
                      <option value="">{{ __('Select seller') }}</option>
                      @foreach ($sellers as $seller)
                          <option value="{{ $seller->id }}" @selected(request()->query('seller') == $seller->id)>
                              {{ $seller->name }}
                          </option>
                      @endforeach
                  </select>
              </div>
              <div class="pb-4 mb-2">
                  <h3 class="h6 text-light">{{ __('Show only ad with video') }}</h3>
                  <div class="form-check form-switch form-switch-light">
                      <input id="only_ad_video" name="only_ad_video" @checked(request()->query('only_ad_video'))
                          class="form-check-input" type="checkbox"
                          value="{{ request()->query('only_ad_video') ? '' : true }}">
                      <label class="form-check-label fs-sm"
                          for="only_ad_video">{{ __('Show only ad with video') }}</label>
                  </div>
              </div>
                      <div class="pb-4 mb-2">
                          <h3 class="h6 text-light">{{ __('Features') }}</h3>
                          <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-inverse style="height: 11rem;">
                              @foreach ($features as $k => $v)
                                  <div class="form-check form-check-light">
                                      <input value="{{ $k }}" @checked(collect(request()->query('features', []))->contains($k))
                                      class="form-check-input feature" type="checkbox"
                                             id="{{ $k }}">
                                      <label class="form-check-label fs-sm"
                                             for="{{ $k }}">{{ $v }}</label>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
          </div>
      </div>
  </div>

  @push('js-end')
      <script>
          const keywords = document.querySelector('#keywords');
          const transmission = document.querySelector('#transmission');
          const type = document.querySelector('#type');
          const drive = document.querySelector('#drive');
          const cylinder = document.querySelector('#cylinder');
          const fuel = document.querySelector('#fuel');
          const exterior_color = document.querySelector('#exterior_color');
          const interior_color = document.querySelector('#interior_color');
          const seller = document.querySelector('#seller');
          const is_negotiated = document.querySelector('#is_negotiated');
          const only_ad_video = document.querySelector('#only_ad_video');
          const rangeYear = document.querySelector('.range-slider-year');
          const from_year = document.querySelector('#from-year');
          const to_year = document.querySelector('#to-year');
          const make = document.querySelector('#make');
          const model = document.querySelector('#model');
          const rangePrice = document.querySelector('.range-slider-price');
          const minPrice = document.querySelector('#minPrice');
          const maxPrice = document.querySelector('#maxPrice');
          const rangeMileage = document.querySelector('.range-slider-mileage');
          const mileageMin = document.querySelector('#mileage-min');
          const mileageMax = document.querySelector('#mileage-max');
          const sort = document.querySelector('#sort');
          const btnsremoveparams = document.querySelectorAll('.remove-param');
          const features = document.querySelectorAll('.feature');
          const pathFeatures = 'features[]';

          features.forEach((feature) => {
              feature.addEventListener('change', (event) => {
                  const selectedValue = event.target.value;
                  const url = new URL(window.location);
                  const currentValues = url.searchParams.getAll(pathFeatures);

                  if (currentValues.includes(selectedValue)) {
                      const newValues = currentValues.filter(value => value !== selectedValue);
                      url.searchParams.delete(pathFeatures);
                      newValues.forEach(value => url.searchParams.append(pathFeatures, value));
                  } else {
                      url.searchParams.append(pathFeatures, selectedValue);
                  }

                  url.searchParams.delete('page');
                  history.pushState({},null,url);
                  history.go(0);
              });
          });

          rangePrice.noUiSlider.on('set',()=>{
              const url = new URL(window.location);
              url.searchParams.set('min_price', minPrice.value);
              url.searchParams.set('max_price', maxPrice.value);
              url.searchParams.delete('page');
              history.pushState({},null,url);
              history.go(0);
          });

          rangeYear.noUiSlider.on('set',()=>{
              const url = new URL(window.location);
              url.searchParams.set('from_year', from_year.value);
              url.searchParams.set('to_year', to_year.value);
              url.searchParams.delete('page');
              history.pushState({},null,url);
              history.go(0);
          });

          rangeMileage.noUiSlider.on('set', () => {
            const url = new URL(window.location);
            url.searchParams.set('mileage_min', mileageMin.value);
            url.searchParams.set('mileage_max', mileageMax.value);
            url.searchParams.delete('page');
            history.pushState({},null,url);
            history.go(0);
        });

          keywords.addEventListener('focusout', (event) => {
              addQuery(event, 'keywords');
          });

          btnsremoveparams.forEach((btn) => {
              btn.addEventListener('click', (event) => {
                  if (event.target.getAttribute('data-key') != 'make') {
                      return removeQuery(event.target.getAttribute('data-key'));
                  }
                  const url = new URL(window.location);
                  url.searchParams.delete('model');
                  url.searchParams.delete('make');
                  history.pushState({},null,url);
                  history.go(0);
              })
          })

          make.addEventListener('change', (event) => {
              addQueryMake(event, 'make');
          });

          model.addEventListener('change', (event) => {
              addQueryMake(event, 'model');
          });

          transmission.addEventListener('change', (event) => {
              addQuery(event, 'transmission');
          });

          type.addEventListener('change', (event) => {
              addQuery(event, 'type');
          });

          drive.addEventListener('change', (event) => {
              addQuery(event, 'drive');
          });

          cylinder.addEventListener('change', (event) => {
              addQuery(event, 'cylinder');
          });

          fuel.addEventListener('change', (event) => {
              addQuery(event, 'fuel');
          });

          exterior_color.addEventListener('change', (event) => {
              addQuery(event, 'exterior_color');
          });

          interior_color.addEventListener('change', (event) => {
              addQuery(event, 'interior_color');
          });

          seller.addEventListener('change', (event) => {
              addQuery(event, 'seller');
          });

          is_negotiated.addEventListener('change', (event) => {
              addQuery(event, 'is_negotiated');
          });

          only_ad_video.addEventListener('change', (event) => {
              addQuery(event, 'only_ad_video');
          });

          sort.addEventListener('change', (event) => {
              addQuery(event, 'sort');
          });

          const addQuery = async (event, path) => {
              const selectedValue = event.target.value;
              const url = new URL(window.location);
              url.searchParams.set(path, selectedValue);
              url.searchParams.delete('page');
              history.pushState({},null,url);
              history.go(0);
          }

          const addLinkQuery = async (value, path) => {
              const selectedValue = value;
              const url = new URL(window.location);
              url.searchParams.set(path, selectedValue);
              url.searchParams.delete('page');
              history.pushState({},null,url);
              history.go(0);
          }

          const removeQuery = (path) => {
              const url = new URL(window.location);
              url.searchParams.delete(path);

              if(path == 'features')
              {
                 url.searchParams.delete(pathFeatures);
              }else{
                 url.searchParams.delete(path);
              }

              history.pushState({},null,url);
              history.go(0);
          }

          const addQueryMake = (event, path) => {
              const selectedValue = event.target.value;
              const url = new URL(window.location);
              url.searchParams.delete('model');
              url.searchParams.delete('page');
              url.searchParams.set(path, selectedValue);
              history.pushState({},null,url);
              history.go(0);
          }
      </script>
  @endpush
