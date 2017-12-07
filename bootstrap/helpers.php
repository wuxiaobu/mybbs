<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

//class active
function active($url)
{
    if(strpos($url,'?') !== false){
        $url = explode('=',$url)[1];
        return $url;
    }
    return false;
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}