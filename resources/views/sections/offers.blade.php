 @php
     $listings = \App\Models\Listing::query()
         ->whereIn('id', $data['listings'])
         ->with('user', 'make', 'makemodel', 'type', 'transmission', 'fueltype', 'engine', 'drivetype', 'exteriorcolor', 'interiorcolor', 'offertype', 'features', 'currency', 'condition')
         ->approved()
         ->get();
 @endphp
 @if($listings->count() > 0)
 <section class="container pt-sm-1 pb-5 mb-md-4">
     <div class="d-sm-flex align-items-center justify-content-between mb-4 pb-sm-2">
         <h2 class="h3 text-light mb-2 mb-sm-0">{{ $data['title'] }}</h2>
         <a class="btn btn-link btn-light fw-normal px-0" href="{{ route('listing.index') }}">{{ __('View all offers') }}
             <i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i>
         </a>
     </div>
     <div class="row">
        @if($listings->count() > 0)
         <div class="col-lg-6">
             <!-- Item-->
             @foreach ($listings->slice(0,1) as $listing)
            <x-listing-grid thumb="featured" class="card card-light card-hover h-lg-100 mb-4 mb-lg-0" :listing="$listing" />
             @endforeach
         </div>
         @endif
         @if($listings->count() > 1)
         <div class="col-lg-6">
            @foreach ($listings->slice(1,3) as $listing)
             <!-- Item-->
             <x-listing-list thumb="small" :class="$loop->first ? 'card card-light card-hover card-horizontal mb-4' : 'card card-light card-hover card-horizontal'" :listing="$listing" />
             @endforeach
         </div>
         @endif
     </div>
 </section>
@endif
