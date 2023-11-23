<?php

namespace MillCloud\LaravelIgnition\FlareMiddleware;

use Closure;
use MillCloud\FlareClient\FlareMiddleware\FlareMiddleware;
use MillCloud\FlareClient\Report;
use MillCloud\LaravelIgnition\Recorders\DumpRecorder\DumpRecorder;

class AddDumps implements FlareMiddleware
{
    protected DumpRecorder $dumpRecorder;

    public function __construct()
    {
        $this->dumpRecorder = app(DumpRecorder::class);
    }

    public function handle(Report $report, Closure $next)
    {
        $report->group('dumps', $this->dumpRecorder->getDumps());

        return $next($report);
    }
}
