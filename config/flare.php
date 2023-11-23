<?php

use MillCloud\FlareClient\FlareMiddleware\AddGitInformation;
use MillCloud\FlareClient\FlareMiddleware\RemoveRequestIp;
use MillCloud\FlareClient\FlareMiddleware\CensorRequestBodyFields;
use MillCloud\FlareClient\FlareMiddleware\CensorRequestHeaders;
use MillCloud\LaravelIgnition\FlareMiddleware\AddDumps;
use MillCloud\LaravelIgnition\FlareMiddleware\AddEnvironmentInformation;
use MillCloud\LaravelIgnition\FlareMiddleware\AddExceptionInformation;
use MillCloud\LaravelIgnition\FlareMiddleware\AddJobs;
use MillCloud\LaravelIgnition\FlareMiddleware\AddLogs;
use MillCloud\LaravelIgnition\FlareMiddleware\AddQueries;
use MillCloud\LaravelIgnition\FlareMiddleware\AddNotifierName;

return [
    /*
    |
    |--------------------------------------------------------------------------
    | Flare API key
    |--------------------------------------------------------------------------
    |
    | Specify Flare's API key below to enable error reporting to the service.
    |
    | More info: https://flareapp.io/docs/general/projects
    |
    */

    'key' => env('FLARE_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will modify the contents of the report sent to Flare.
    |
    */

    'flare_middleware' => [
        RemoveRequestIp::class,
        AddGitInformation::class,
        AddNotifierName::class,
        AddEnvironmentInformation::class,
        AddExceptionInformation::class,
        AddDumps::class,
        AddLogs::class => [
            'maximum_number_of_collected_logs' => 200,
        ],
        AddQueries::class => [
            'maximum_number_of_collected_queries' => 200,
            'report_query_bindings' => true,
        ],
        AddJobs::class => [
            'max_chained_job_reporting_depth' => 5,
        ],
        CensorRequestBodyFields::class => [
            'censor_fields' => [
                'password',
                'password_confirmation',
            ],
        ],
        CensorRequestHeaders::class => [
            'headers' => [
                'API-KEY',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Reporting log statements
    |--------------------------------------------------------------------------
    |
    | If this setting is `false` log statements won't be sent as events to Flare,
    | no matter which error level you specified in the Flare log channel.
    |
    */

    'send_logs_as_events' => true,
];
