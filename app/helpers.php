<?php

if (! function_exists('is_active')) {
    function is_active($routeName)
    {
        return Route::currentRouteName() == $routeName ? 'active' : '';
    }
}
