<nav class="{{$class ?? 'mb-4 pt-md-3'}}" aria-label="{{__('Breadcrumb')}}">
    <ol class="breadcrumb breadcrumb-light">
        @foreach ($routes as $route)
        <li class="breadcrumb-item">
            <a @if($route['link']) href="{{$route['link']}}" @endif>{{$route['name']}}</a>
        </li>
        @endforeach
        <li class="breadcrumb-item active" aria-current="page">{{$active}}</li>
    </ol>
</nav>
