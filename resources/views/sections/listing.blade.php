@php
    $listings = \App\Models\Listing::query()
    ->limit($data['limit'])
    ->when($data['is_featured'],function($query){
        return $query->Featured();
    })
       ->when($data['is_certified'],function($query){
        return $query->where('is_certified', true);
    })
       ->when($data['is_negotiated'],function($query){
        return $query->where('is_negotiated', true);
    })
       ->when($data['is_single_owner'],function($query){
        return $query->where('is_single_owner', true);
    })
       ->when($data['is_well_equipped'],function($query){
        return $query->where('is_well_equipped', true);
    })
       ->when($data['no_accident'],function($query){
        return $query->where('no_accident',true);
    })
    ->with('user', 'make', 'makemodel', 'type', 'transmission', 'fueltype', 'engine', 'drivetype', 'exteriorcolor', 'interiorcolor', 'offertype', 'features', 'currency', 'condition')
    ->approved()
    ->OwnerHasSubscriptionActived()
    ->orderByDesc('created_at')
    ->get()
@endphp
@if($listings->count())
<section class="container pt-sm-5 pt-4 pb-3">
      <div class="d-sm-flex align-items-center justify-content-between mb-3 mb-sm-4 pb-2">
          <h2 class="h3 text-light mb-3 mb-sm-0">{{ $data['title'] }}</h2>
          <div class="d-flex align-items-center">
              <a class="btn btn-link btn-light fw-normal px-0" href="{{route('listing.index')}}">
                  {{__('View all')}}<i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i>
              </a>
          </div>
      </div>
      <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-carousel-light">
          <div class="tns-carousel-inner"
              data-carousel-options='{"loop": false,"items": 0, "responsive": {"0":{"items":1, "gutter": 16},"500":{"items":2, "gutter": 18},"900":{"items":3, "gutter": 20}, "1100":{"gutter": 24}}}'>
              @foreach ($listings as $listing)
                  <div>
                    <x-listing-grid :listing="$listing" />
                  </div>
              @endforeach
          </div>
      </div>
</section>
@endif
