<div class="row g-4 gallery mb-3" data-video="true">

    <!-- Item -->
    @foreach($data['images'] as $image)
    <div class="col-xl-4 col-sm-6">
        <a href="{{Storage::url($image)}}" class="gallery-item rounded-2">
            <img src="{{Storage::url($image)}}" alt="{{__('Gallery thumbnail')}}">
        </a>
    </div>
    @endforeach
</div>
