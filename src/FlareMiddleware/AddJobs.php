<?php

namespace MillCloud\LaravelIgnition\FlareMiddleware;

use MillCloud\FlareClient\FlareMiddleware\FlareMiddleware;
use MillCloud\FlareClient\Report;
use MillCloud\LaravelIgnition\Recorders\JobRecorder\JobRecorder;

class AddJobs implements FlareMiddleware
{
    protected JobRecorder $jobRecorder;

    public function __construct()
    {
        $this->jobRecorder = app(JobRecorder::class);
    }

    public function handle(Report $report, $next)
    {
        if ($job = $this->jobRecorder->getJob()) {
            $report->group('job', $job);
        }

        return $next($report);
    }
}
