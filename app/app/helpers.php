<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('assets')) {
    /**
     * Get the application public assets path.
     * @param string $file The asset file path.
     * @return string
     */
    function assets($file)
    {
        return asset(sprintf(
            'assets/%s?v=%s',
            trim($file, '/'),
            env('APP_ENV') == 'local' ? mt_rand(0000, 9999) : config('app.version', '0')
        ));
    }
}

if (!function_exists('in_route')) {
    /**
     * Get the current route name.
     * @param string $file The route to check.
     * @return string
     */
    function in_route($routeName = '')
    {
        $currentRouteName = Route::currentRouteName();

        if (empty($routeName)) {
            return $currentRouteName;
        } elseif (strpos($routeName, '#') === 0) {
            return strpos($currentRouteName, substr($routeName, 1) . '.') === 0 ? 'active fw-bold' : '';
        }

        return $currentRouteName === $routeName ? 'active fw-bold' : '';
    }
}
