<?php 


if (!function_exists('getMenuActive')) {
    function getMenuActive($ruta)
    {
        //if (request()->is($ruta) || request()->is($ruta . '/*')) {
        if (request()->is($ruta)) {
            return 'active';
        } else {
            return '';
        }
    }
}