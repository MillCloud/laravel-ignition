<?php

namespace MillCloud\LaravelIgnition\ContextProviders;

use Illuminate\Http\Request;
use Livewire\LivewireManager;
use MillCloud\FlareClient\Context\ContextProvider;
use MillCloud\FlareClient\Context\ContextProviderDetector;

class LaravelContextProviderDetector implements ContextProviderDetector
{
    public function detectCurrentContext(): ContextProvider
    {
        if (app()->runningInConsole()) {
            return new LaravelConsoleContextProvider($_SERVER['argv'] ?? []);
        }

        $request = app(Request::class);

        if ($this->isRunningLiveWire($request)) {
            return new LaravelLivewireRequestContextProvider($request, app(LivewireManager::class));
        }

        return new LaravelRequestContextProvider($request);
    }

    protected function isRunningLiveWire(Request $request): bool
    {
        return $request->hasHeader('x-livewire') && $request->hasHeader('referer');
    }
}
