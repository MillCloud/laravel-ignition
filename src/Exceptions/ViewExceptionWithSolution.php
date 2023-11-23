<?php

namespace MillCloud\LaravelIgnition\Exceptions;

use MillCloud\Ignition\Contracts\ProvidesSolution;
use MillCloud\Ignition\Contracts\Solution;

class ViewExceptionWithSolution extends ViewException implements ProvidesSolution
{
    protected Solution $solution;

    public function setSolution(Solution $solution): void
    {
        $this->solution = $solution;
    }

    public function getSolution(): Solution
    {
        return $this->solution;
    }
}
