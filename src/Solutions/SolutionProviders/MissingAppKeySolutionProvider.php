<?php

namespace MillCloud\LaravelIgnition\Solutions\SolutionProviders;

use RuntimeException;
use MillCloud\Ignition\Contracts\HasSolutionsForThrowable;
use MillCloud\LaravelIgnition\Solutions\GenerateAppKeySolution;
use Throwable;

class MissingAppKeySolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        if (! $throwable instanceof RuntimeException) {
            return false;
        }

        return $throwable->getMessage() === 'No application encryption key has been specified.';
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [new GenerateAppKeySolution()];
    }
}
