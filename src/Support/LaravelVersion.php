<?php

namespace MillCloud\LaravelIgnition\Support;

class LaravelVersion
{
    public static function major(): string
    {
        return explode('.', app()->version())[0];
    }
}
