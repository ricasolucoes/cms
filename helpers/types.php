<?php

/**
 * @param  $value
 * @return bool
 */
if (!function_exists('to_bool')) {
    function to_bool($value): bool
    {
        return (bool) $value;
    }
}

/**
 * @param  $value
 * @return null|int
 */
if (!function_exists('to_int')) {
    function to_int($value): ?int
    {
        if (is_numeric($value) && $value == 0) {
            return (int) $value;
        }

        if (is_string($value) && $value == 0) {
            return (int) $value;
        }

        if ($value) {
            return (int) $value;
        }

        return null;
    }
}

/**
 * @param  $value
 * @return null|float
 */
if (!function_exists('to_float')) {
    function to_float($value): ?float
    {
        if (is_numeric($value) && $value == 0) {
            return (float) $value;
        }

        if (is_string($value) && $value == 0) {
            return (float) $value;
        }

        if ($value) {
            return (float) $value;
        }

        return null;
    }
}

/**
 * @param  $value
 * @return null|string
 */
if (!function_exists('to_string')) {
    function to_string($value): ?string
    {
        return $value ? (string) $value : null;
    }
}

/**
 * @param  $value
 * @return null|array
 */
if (!function_exists('to_array')) {
    function to_array($value): ?array
    {
        return $value ? (array) $value : null;
    }
}

/**
 * @param  $value
 * @param  string $className
 * @return null|object
 */
if (!function_exists('to_object')) {
    function to_object($value, string $className)
    {
        return $value ? new $className($value) : null;
    }
}
