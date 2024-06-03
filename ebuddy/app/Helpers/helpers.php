<?php

use Illuminate\Support\Facades\Route;
// app/Helpers/helpers.php

if (! function_exists('isActiveRoute')) {
    function isActiveRoute($routePattern)
    {
        return request()->routeIs($routePattern) ? 'active' : '';
    }
}
