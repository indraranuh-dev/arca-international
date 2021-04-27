<?php

use Illuminate\Support\Str;

/**
 * Defines the active class on the sidebar
 *
 * @param string $routeName
 * @return void
 */
function active_class(string $routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}

/**
 * Defines the expanded attribute on the sidebar
 *
 * @param string $routeName
 * @return void
 */
function is_active_route(string $routeName)
{
    return request()->routeIs($routeName) ? 'true' : 'false';
}

/**
 * Defines the show class on the sidebar
 *
 * @param string $routeName
 * @return void
 */
function show_class(string $routeName)
{
    return request()->routeIs($routeName) ? 'show' : '';
}

/**
 * Creates a slug from defined strings
 *
 * @param string $string
 * @return void
 */
function slug(string $string)
{
    return Str::slug($string);
}

/**
 * Converts integer format to currency
 *
 * @param int $value
 * @param string $currency
 * @param bool $inFront
 * @return void
 */
function currency(int $value, string $currency, bool $inFront = true)
{
    $formatedValue = number_format($value, 2, ',', '.');
    return $inFront ? $currency . ' ' . $formatedValue : $formatedValue . ' ' . $currency;
}