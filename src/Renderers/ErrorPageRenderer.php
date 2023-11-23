<?php

namespace MillCloud\LaravelIgnition\Renderers;

use MillCloud\FlareClient\Flare;
use MillCloud\Ignition\Config\IgnitionConfig;
use MillCloud\Ignition\Contracts\SolutionProviderRepository;
use MillCloud\Ignition\Ignition;
use MillCloud\LaravelIgnition\ContextProviders\LaravelContextProviderDetector;
use MillCloud\LaravelIgnition\Solutions\SolutionTransformers\LaravelSolutionTransformer;
use MillCloud\LaravelIgnition\Support\LaravelDocumentationLinkFinder;
use Throwable;

class ErrorPageRenderer
{
    public function render(Throwable $throwable): void
    {
        $viteJsAutoRefresh = '';

        if (class_exists('Illuminate\Foundation\Vite')) {
            $vite = app(\Illuminate\Foundation\Vite::class);

            if (is_file($vite->hotFile())) {
                $viteJsAutoRefresh = $vite->__invoke([]);
            }
        }

        app(Ignition::class)
            ->resolveDocumentationLink(
                fn (Throwable $throwable) => (new LaravelDocumentationLinkFinder())->findLinkForThrowable($throwable)
            )
            ->setFlare(app(Flare::class))
            ->setConfig(app(IgnitionConfig::class))
            ->setSolutionProviderRepository(app(SolutionProviderRepository::class))
            ->setContextProviderDetector(new LaravelContextProviderDetector())
            ->setSolutionTransformerClass(LaravelSolutionTransformer::class)
            ->applicationPath(base_path())
            ->addCustomHtmlToHead($viteJsAutoRefresh)
            ->renderException($throwable);
    }
}
