<?php

namespace MillCloud\LaravelIgnition\Http\Controllers;

use MillCloud\Ignition\Config\IgnitionConfig;
use MillCloud\LaravelIgnition\Http\Requests\UpdateConfigRequest;

class UpdateConfigController
{
    public function __invoke(UpdateConfigRequest $request)
    {
        $result = (new IgnitionConfig())->saveValues($request->validated());

        return response()->json($result);
    }
}
