<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('setActive')) {
    function setActive($routeName, $active = 'active', $none = '')
    {
        return request()->routeIs($routeName) ? $active : $none;
    }
}

if (!function_exists('gs')) {
    function gs($key = '')
    {
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
        return gs('site_logo') ? asset(gs('site_logo')) : null;
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
        return asset(gs('site_favicon'));
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
