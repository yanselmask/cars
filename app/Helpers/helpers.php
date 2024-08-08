<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

if (!function_exists('setActive')) {
    function setActive($routeName, $active = 'active', $none = '')
    {
        return request()->routeIs($routeName) ? $active : $none;
    }
}

if (!function_exists('getPath')) {
    function getPath($key, $withUrl = false)
    {
        return match($key){
            'vendor' => ($withUrl ? \Illuminate\Support\Str::of(config('listing.vendor_path'))
                        ->start(config('app.url') . '/')
                        ->append('/')
                        : config('listing.vendor_path')),
            'admin' =>  ($withUrl ? \Illuminate\Support\Str::of(config('listing.admin_path'))
                        ->start(config('app.url') . '/')
                        ->append('/')
                        : config('listing.admin_path')),
            'blog' => ($withUrl ? \Illuminate\Support\Str::of(config('listing.path_blog'))
                        ->start(config('app.url') . '/')
                        ->append('/')
                        : config('listing.path_blog')),
            'favorite' => ($withUrl ? \Illuminate\Support\Str::of(config('listing.path_favorites'))
                        ->start(config('app.url') . '/')
                        ->append('/')
                        : config('listing.path_favorites')),
            'compares' => ($withUrl ? \Illuminate\Support\Str::of(config('listing.path_compares'))
                        ->start(config('app.url') . '/')
                        ->append('/')
                        : config('listing.path_compares')),
            'listings' => ($withUrl ? \Illuminate\Support\Str::of(config('listing.path_listing'))
                    ->start(config('app.url') . '/')
                    ->append('/')
                    : config('listing.path_listing')),
            default => null,
        };
    }
}

if (!function_exists('notificationFilament')) {
    function notificationFilament()
    {
        return \Filament\Notifications\Notification::make()
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->button()
                    ->markAsRead()
            ]);
    }
}

if (!function_exists('viewActive')) {
    function viewActive($view = '')
    {
        if(empty($view))
        {
            return config('listing.listing_result_view');
        }

        return (request()->query('view') == $view || !request()->query('view') && config('listing.listing_result_view') == $view) ? true : false;
    }
}

if (!function_exists('nt')) {
    function nt(String $type, String $title, String $message = '')
    {
        request()->session()->flash('notify', [$type ?? 'success', $title, $message]);
    }
}

if (!function_exists('appInstalled')) {
    function appInstalled(): bool
    {
        return file_exists(storage_path('installed'));
    }
}

if (!function_exists('site_name')) {
    function site_name()
    {
        return gs('site_name') ?? config('app.name');
    }
}

if (!function_exists('menu')) {
    function menu($menuHandle)
    {
        if($menuHandle)
        {
            if(config('listing.menus_cached'))
            {
                $key = 'menu.key.' . $menuHandle;
                $menuItems =  Cache::rememberForever($key,function() use($menuHandle){
                return \RyanChandler\FilamentNavigation\Models\Navigation::fromHandle($menuHandle);
                });
            }else{
                $menuItems = \RyanChandler\FilamentNavigation\Models\Navigation::fromHandle($menuHandle);
            }

           return $menuItems;
        }

        return [];
    }
}

if (!function_exists('menuTitle')) {
    function menuTitle($menu)
    {
        $key = 'menu.key.' . $menu . '.name';

        $titleMenu = \RyanChandler\FilamentNavigation\Models\Navigation::where('handle', $menu)->first();

        if (is_null($titleMenu)) {
            return null;
        }

        if (config('listing.menus_cached', false)) {
            return Cache::rememberForever($key, function () use ($titleMenu) {
                return $titleMenu->name;
            });
        }

        return $titleMenu->name;
    }
}

if (!function_exists('gs')) {

    function gs($key = '')
    {
        if(!appInstalled())
        {
            return null;
        }

        $gs = DB::table('general_settings')->first();

        if (!$gs) {
            return null;
        }

        if (!empty($key)) {
            $gs = $gs->$key;
        }

        return $gs;
    }
}

if (!function_exists('site_social')) {
    function site_social($nt = '')
    {
        $all = json_decode(gs('social_network'));

        if (empty($nt)) {
            return $all;
        }

        if (!empty($nt) && str_contains(gs('social_network'), $nt)) {
            return $all = $all->$nt;
        }

        return null;
    }
}

if (!function_exists('site_logo')) {
    function site_logo()
    {
        return gs('site_logo') ? Storage::url(gs('site_logo')) : null;
    }
}

if (!function_exists('site_logo_path')) {
    function site_logo_path()
    {
        return gs('site_logo');
    }
}

if (!function_exists('site_favicon')) {
    function site_favicon()
    {
        return Storage::url(gs('site_favicon'));
    }
}

if (!function_exists('site_favicon_path')) {
    function site_favicon_path()
    {
        return gs('site_favicon');
    }
}

if (!function_exists('copyright')) {
    function copyright()
    {
        return json_decode(gs('more_configs'))?->copyright;
    }
}
