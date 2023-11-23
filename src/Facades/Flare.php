<?php

namespace MillCloud\LaravelIgnition\Facades;

use Illuminate\Support\Facades\Facade;
use MillCloud\LaravelIgnition\Support\SentReports;

/**
 * @method static void glow(string $name, string $messageLevel = \MillCloud\FlareClient\Enums\MessageLevels::INFO, array $metaData = [])
 * @method static void context($key, $value)
 * @method static void group(string $groupName, array $properties)
 *
 * @see \MillCloud\FlareClient\Flare
 */
class Flare extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MillCloud\FlareClient\Flare::class;
    }

    public static function sentReports(): SentReports
    {
        return app(SentReports::class);
    }
}
