<?php

namespace MillCloud\LaravelIgnition\Exceptions;

use Exception;
use Monolog\Level;
use MillCloud\Ignition\Contracts\BaseSolution;
use MillCloud\Ignition\Contracts\ProvidesSolution;
use MillCloud\Ignition\Contracts\Solution;

class InvalidConfig extends Exception implements ProvidesSolution
{
    public static function invalidLogLevel(string $logLevel): self
    {
        return new self("Invalid log level `{$logLevel}` specified.");
    }

    public function getSolution(): Solution
    {
        $validLogLevels = array_map(
            fn (string $level) => strtolower($level),
            array_keys(Level::VALUES)
        );

        $validLogLevelsString = implode(',', $validLogLevels);

        return BaseSolution::create()
            ->setSolutionTitle('You provided an invalid log level')
            ->setSolutionDescription("Please change the log level in your `config/logging.php` file. Valid log levels are {$validLogLevelsString}.");
    }
}
