<?php

namespace MillCloud\LaravelIgnition\FlareMiddleware;

use MillCloud\FlareClient\FlareMiddleware\FlareMiddleware;
use MillCloud\FlareClient\Report;

class AddNotifierName implements FlareMiddleware
{
    public const NOTIFIER_NAME = 'Laravel Client';

    public function handle(Report $report, $next)
    {
        $report->notifierName(static::NOTIFIER_NAME);

        return $next($report);
    }
}
