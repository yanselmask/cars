<x-app-layout>
    <!-- Seo -->
    @include('blog.partials.show.seo')
    <div class="container pt-5 pb-lg-4 my-5">
        <!-- Breadcrumb-->
        @include('blog.partials.show.breadcrumb')
        <!-- Page Content-->
        @include('blog.partials.show.content')
    </div>
</x-app-layout>
