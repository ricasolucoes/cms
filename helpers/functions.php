<?php

/**
 * Get file storage url.
 *
 * @param  string $path
 * @return string
 */
function url_storage(string $path): string
{
    return \Illuminate\Support\Facades\Config::get('main.storage.url') . $path;
}

/**
 * Get main frontend page url.
 *
 * @param  string $path
 * @return string
 */
function url_frontend(string $path = ''): string
{
    return \Illuminate\Support\Facades\Config::get('main.frontend.url') . $path;
}

/**
 * Get sign in frontend page url.
 *
 * @return string
 */
function url_frontend_sign_in(): string
{
    return url_frontend('/sign-in');
}

/**
 * Get photo frontend page url.
 *
 * @param  int $id
 * @return string
 */
function url_frontend_photo(int $id): string
{
    return url_frontend(sprintf('/photo/%s', urlencode($id)));
}

/**
 * Get search by tag frontend page url.
 *
 * @param  string $tag
 * @return string
 */
function url_frontend_tag(string $tag): string
{
    return url_frontend(sprintf('/photos/tag/%s', urlencode($tag)));
}

/**
 * Get unsubscription frontend page url.
 *
 * @param  string $token
 * @return string
 */
function url_frontend_unsubscription(string $token): string
{
    return url_frontend(sprintf('/unsubscription/%s', urlencode($token)));
}
