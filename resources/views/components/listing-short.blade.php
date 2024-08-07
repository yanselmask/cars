<div class="gallery mb-3 row" data-video="true">
    @forelse($listings as $listing)
        <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
        <a href="{{$listing->video_link}}" class="gallery-item video-item rounded-2" data-sub-html="<h6 class='fs-sm text-light'><a class='text-decoration-none' href={{route('listing.show', $listing)}}>{{$listing->name}} - <span class='badge bg-primary'><i class='fi-cash'></i> {{$listing->pricing}}</span></a></h6>">
                <img src="{{$listing->primaryImage}}" alt="{{__('Short Image')}}">
            <span class="gallery-item-caption">{{$listing->name}} - <span class="badge bg-primary"><i class="fi-cash"></i> {{$listing->pricing}}</span></span>
            </a>
        </div>
        @empty
            @include('listing.partials.no-listings')
    @endforelse
</div>
