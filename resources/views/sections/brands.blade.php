@php
    $brands = \App\Models\Make::whereIn('id',$data['brands'])->get();
@endphp
<section class="container py-2 py-sm-3">
    <div class="row g-2 g-sm-4">
        @foreach ($brands as $brand)
        <div class="col-3 col-sm-2 col-xl-1 mb-4 pb-2">
            <a class="opacity-40 opacity-transition d-table mx-auto" href="{{route('listing.index',['make' => $brand->id])}}">
                <img loading="lazy" src="{{$brand->image_url}}" width="86" alt="{{$brand->name}}">
            </a>
        </div>
        @endforeach
    </div>
</section>
