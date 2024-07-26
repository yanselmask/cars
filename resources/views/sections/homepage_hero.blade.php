@php
    $condition = \App\Models\Condition::select('id', 'name')->get();
    $makes = \App\Models\Make::select('id', 'name')->has('listings')->get();
    $types = \App\Models\Type::select('id', 'name')->get();
    $locations = \App\Models\Listing::select('city')
                ->whereNotNull('city')
                ->distinct()
                ->get();
@endphp
<section class="bg-position-top-center bg-repeat-0 pt-5"
    style="
          background-image: url({{ asset('theme/img/hero-bg.png') }});
          background-size: 1920px 630px;
        ">
    <div class="container pt-5">
        <div class="row pt-lg-4 pt-xl-5">
            <div class="col-lg-4 col-md-5 pt-3 pt-md-4 pt-lg-5">
                <h1 class="display-4 text-light pb-2 mb-4 me-md-n5">
                    {!! $data['title'] !!}
                </h1>
                <p class="fs-lg text-light opacity-70">
                    {!! $data['description'] !!}
                </p>
            </div>
            @if ($img = $data['image'])
                <div class="col-lg-8 col-md-7 pt-md-5">
                    <img class="d-block mt-4 ms-auto" src="{{ Storage::url($img) }}" width="800"
                        alt="{{ $data['title'] }}" />
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-4 mt-sm-3 mt-lg-n3 pb-5 mb-md-4">
        <!-- Form group-->
        <form class="form-group form-group-light d-block" action="{{ route('listing.index') }}">
            <span x-text="make"></span>
            <div class="row g-0 ms-lg-n2">
                <div class="col-lg-2">
                    <div class="input-group border-end-lg border-light"><span
                            class="input-group-text text-muted ps-2 ps-sm-3"><i class="fi-search"></i></span>
                        <input class="form-control" type="text" name="keywords" placeholder="{{__('Keywords...')}}">
                    </div>
                </div>
                <hr class="hr-light d-lg-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown border-end-sm border-light" data-bs-toggle="select">
                        <button id="btnDropdownSelect" class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fi-list me-2"></i><span class="dropdown-toggle-label">{{ __('Make') }}</span>
                        </button>
                        <input id="selectedMake" type="hidden" name="make">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                            @foreach ($makes as $make)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$make->name}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-sm-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown border-end-md border-light" data-bs-toggle="select">
                        <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-list me-2"></i><span
                                class="dropdown-toggle-label">{{{__('Condition')}}}</span></button>
                        <input type="hidden" name="condition">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                               @foreach ($condition as $c)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$c->name}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-md-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown border-end-sm border-light" data-bs-toggle="select">
                        <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-car fs-lg me-2"></i><span
                                class="dropdown-toggle-label">{{__('Body type')}}</span></button>
                        <input type="hidden" name="type">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                         @foreach ($types as $type)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$type->name}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-sm-none my-2">
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="dropdown" data-bs-toggle="select">
                        <button class="btn btn-link dropdown-toggle ps-2 ps-sm-3" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fi-map-pin me-2"></i><span
                                class="dropdown-toggle-label">{{__('Location')}}</span></button>
                        <input type="hidden" name="location">
                        <ul class="dropdown-menu dropdown-menu-dark" style="">
                            @foreach ($locations as $location)
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="dropdown-item-label">{{$location->city}}</span>
                                </a>
                            </li>
                              @endforeach
                        </ul>
                    </div>
                </div>
                <hr class="hr-light d-lg-none my-2">
                <div class="col-lg-2">
                    <button class="btn btn-primary w-100" type="submit">{{__('Search')}}</button>
                </div>
            </div>
        </form>
    </div>
</section>
