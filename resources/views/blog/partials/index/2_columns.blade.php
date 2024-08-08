@if($features->count() > 0 && count(request()->query()) == 0)
<div class="row row-cols-1 row-cols-md-2 gy-md-5 gy-4 mb-lg-5 mb-4">
    @foreach ($features as $post)
        <x-post-grid-lg :post="$post" />
    @endforeach
</div>
@endif
