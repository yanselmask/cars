<x-app-layout>
     <div class="container pt-5 pb-lg-4 my-5">
        <!-- Breadcrumb-->
        <x-breadcrumb :routes="[
            [
                'name' => __('Home'),
                'link' => route('home')
            ]
        ]" active="{{__('Blog')}}" />
        <!-- Page title-->
        <h1 class="text-light mb-4">{{$titlePage}}</h1>
        <!-- Sorting, filters and search-->
        <form action="{{route('blog.index')}}">
        <div class="d-lg-flex pt-1 pb-4 mb-3">
          <div class="d-flex mb-3 mb-lg-0 pe-lg-2">
            <div class="d-flex flex-md-row flex-column align-items-md-center flex-grow-1 border-end-md border-light pe-md-4 me-md-4">
              <label class="d-inline-block text-light me-sm-2 mb-md-0 mb-2 text-nowrap" for="sortby"><i class="fi-arrows-sort mt-n1 me-2 align-middle opacity-70"></i>Sort by:</label>
              <select name="sort" class="form-select form-select-light me-md-2" id="sortby">
                <option value="desc" @selected(request()->query('sort') == 'desc')>{{__('Newest')}}</option>
                <option value="asc" @selected(request()->query('sort') == 'asc')>{{__('Oldest')}}</option>
              </select>
            </div>
            <div class="d-flex flex-md-row flex-column align-items-md-center flex-grow-1 border-end-lg border-light ps-3 ps-md-2 pe-lg-4 me-lg-4">
              <label class="d-inline-block text-light me-sm-2 mb-md-0 mb-2 text-nowrap" for="categories"><i class="fi-align-left mt-n1 me-2 align-middle opacity-70"></i>{{__('Category')}}:</label>
              <select name="category" class="form-select form-select-light me-lg-2" id="categories">
                <option value="">{{__('Any')}}</option>
                @foreach ($categories as $key => $name)
                    <option value="{{$key}}" @selected($key == request()->query('category'))>{{$name}}</option>
                @endforeach
              </select>
            </div>
             <div class="d-flex flex-md-row flex-column align-items-md-center flex-grow-1 border-end-lg border-light ps-3 ps-md-2 pe-lg-4 me-lg-4">
              <label class="d-inline-block text-light me-sm-2 mb-md-0 mb-2 text-nowrap" for="tags"><i class="fi-align-left mt-n1 me-2 align-middle opacity-70"></i>{{__('Tag')}}:</label>
              <select name="tag" class="form-select form-select-light me-lg-2" id="tags">
                <option value="">{{__('Any')}}</option>
                @foreach ($tags as $key => $name)
                    <option value="{{$name}}" @selected($name == request()->query('tag'))>{{$name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="position-relative flex-grow-1">
             <input name="q" value="{{request()->query('q')}}" class="form-control form-control-light" type="text" placeholder="{{__('Search articles by keywords...')}}">
            <i class="fi-search position-absolute top-50 end-0 translate-middle-y text-light opacity-70 me-3"></i>
          </div>
        </div>
        </form>
        @if($featuredPost && count(request()->query()) == 0)
        <!-- Featured article-->
        <x-post-grid-xl :post="$featuredPost" />
        @endif
        @if($features->count() > 0 && count(request()->query()) == 0)
        <!-- Latest articles (2 columns)-->
        <div class="row row-cols-1 row-cols-md-2 gy-md-5 gy-4 mb-lg-5 mb-4">
            @foreach ($features as $post)
                <x-post-grid-lg :post="$post" />
            @endforeach
        </div>
        @endif
        <!-- Latest articles (3 columns)-->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 gy-md-5 gy-4 mb-lg-5 mb-4">
        @foreach ($posts as $post)
        <x-post-grid-md :post="$post" />
        @endforeach
        </div>
        <!-- Pagination-->
        <nav class="border-top border-light pt-4" aria-label="Reviews pagination">
            {{$posts->withQueryString()->links()}}
        </nav>
      </div>
</x-app-layout>
