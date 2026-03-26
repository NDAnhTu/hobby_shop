<?php

namespace Core;

class Validator
{
    public static function string($value, $minLength = 1, $maxLength = INF)
    {
        $value = trim($value);
        return strlen($value) >= $minLength && strlen($value) < $maxLength;
    }

    public static function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
