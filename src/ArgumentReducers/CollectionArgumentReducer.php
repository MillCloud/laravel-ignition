<?php

namespace MillCloud\LaravelIgnition\ArgumentReducers;

use Illuminate\Support\Collection;
use MillCloud\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use MillCloud\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use MillCloud\Backtrace\Arguments\Reducers\ArrayArgumentReducer;

class CollectionArgumentReducer extends ArrayArgumentReducer
{
    public function execute(mixed $argument): ReducedArgumentContract
    {
        if (! $argument instanceof Collection) {
            return UnReducedArgument::create();
        }

        return $this->reduceArgument($argument->toArray(), get_class($argument));
    }
}
