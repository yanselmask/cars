<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 gy-md-5 gy-4 mb-lg-5 mb-4">
    @foreach ($posts as $post)
        <x-post-grid-md :post="$post" />
    @endforeach
</div>
