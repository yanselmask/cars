@php
    $types = \App\Models\Type::select('id', 'name', 'icon')
        ->whereIn('id', $data['types'])
        ->get();
@endphp
<section class="container pb-5 mb-md-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-3 mb-sm-4 pb-sm-2">
        <h2 class="h3 text-light mb-2 mb-sm-0">{{ $data['title'] }}</h2>
        <a class="btn btn-link btn-light fw-normal px-0" href="{{route('listing.index')}}">
            {{__('View all')}}<i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i>
        </a>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2 g-md-4">
        @foreach ($types as $type)
            <!-- Item-->
            <div class="col">
                <div class="card card-body card-light card-hover bg-transparent border-0 px-0 pt-0 text-center">
                    <img loading="lazy" class="d-block mx-auto mb-3" src="{{$type->icon_url}}" width="160"
                        alt="{{ $type->name }}" />
                    <a class="nav-link-light stretched-link fw-bold"
                        href="{{route('listing.index', ['type' => $type->id])}}">{{ $type->name }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
