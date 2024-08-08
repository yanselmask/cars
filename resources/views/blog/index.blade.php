<x-app-layout>
     <div class="container pt-5 pb-lg-4 my-5">
        <!-- Breadcrumb-->
         @include('blog.partials.index.breadcrumb')
        <!-- Page title-->
         @include('blog.partials.index.title')
         <!-- Sorting, filters and search-->
         @include('blog.partials.index.sorting')
         @if($featuredPost && count(request()->query()) == 0)
        <!-- Featured article-->
        <x-post-grid-xl :post="$featuredPost" />
         @endif
        <!-- Latest articles (2 columns)-->
         @include('blog.partials.index.2_columns')
        <!-- Latest articles (3 columns)-->
         @include('blog.partials.index.3_columns')
        <!-- Pagination-->
         @include('blog.partials.index.pagination')
      </div>
</x-app-layout>
