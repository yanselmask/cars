@if ($menu == 'header')
    <div class="collapse navbar-collapse order-lg-2" id="navbarNav">
        <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
            @foreach ($menuItems as $item)
                <li class="nav-item">
                    <a class="nav-link {{strlen($item['url']) == 1 && setActive('home') ? 'active' : ''}} {{ request()->path() == substr($item['url'],1) && strlen($item['url']) > 1 ? 'active' : ''}}" href="{{ $item['route'] ? route($item['route']) : $item['url'] }}" @if($item['blank']) target="_blank" @endif>
                        {{ $item['title'][app()->getLocale()] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@elseif ($menu == 'footer_bottom')
    <ul class="d-flex flex-wrap justify-content-center order-lg-2 mb-3 list-unstyled">
         @foreach ($menuItems as $item)
        <li><a href="{{ $item['route'] ? route($item['route']) : $item['url'] }}" class="nav-link nav-link-light fw-normal me-2" @if($item['blank']) target="_blank" @endif>{{ $item['title'][app()->getLocale()] }}</a></li>
          @endforeach
    </ul>
@else
    <h3 class="fs-base text-light">{{ menuTitle($menu) }}</h3>
    <ul class="list-unstyled fs-sm">
        @foreach ($menuItems as $item)
            <li>
                <a class="nav-link-light" href="{{ $item['route'] ? route($item['route']) : $item['url'] }}" @if($item['blank']) target="_blank" @endif>
                    {{ $item['title'][app()->getLocale()] }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
