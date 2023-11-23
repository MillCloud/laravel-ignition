<?php

namespace MillCloud\LaravelIgnition\FlareMiddleware;

use MillCloud\FlareClient\FlareMiddleware\FlareMiddleware;
use MillCloud\FlareClient\Report;
use MillCloud\LaravelIgnition\Recorders\LogRecorder\LogRecorder;

class AddLogs implements FlareMiddleware
{
    protected LogRecorder $logRecorder;

    public function __construct()
    {
        $this->logRecorder = app(LogRecorder::class);
    }

    public function handle(Report $report, $next)
    {
        $report->group('logs', $this->logRecorder->getLogMessages());

        return $next($report);
    }
}
