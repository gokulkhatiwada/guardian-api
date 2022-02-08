<?php


if(!function_exists('settings')){
    function settings($key=null, $default=null){
        return Setting::get($key, $default);
    }
}