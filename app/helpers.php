<?php

use App\Application;

if (!function_exists('container')) {
    function container($service = false)
    {
        $container = Application::getInstance()->getContainer();

        if ($service) {
            return $container->get($service);
        }
        return $container;
    }
}

if (!function_exists('make')) {
    function make($class)
    {
        return container()->make($class);
    }
}

function view()
{
    return container('view');
}

function action_path($handler, $action)
{
    return "$handler::$action";
}

// Dev functions

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        foreach (func_get_args() as $value) {
            d($value);
        }
        die(1);
    }
}

if (!function_exists('d')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function d()
    {
        foreach (func_get_args() as $value) {
            dump($value);
        }
    }
}