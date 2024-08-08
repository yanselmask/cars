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
