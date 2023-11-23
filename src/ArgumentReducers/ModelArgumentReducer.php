<?php

namespace MillCloud\LaravelIgnition\ArgumentReducers;

use Illuminate\Database\Eloquent\Model;
use MillCloud\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use MillCloud\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use MillCloud\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use MillCloud\Backtrace\Arguments\Reducers\ArgumentReducer;

class ModelArgumentReducer implements ArgumentReducer
{
    public function execute(mixed $argument): ReducedArgumentContract
    {
        if (! $argument instanceof Model) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            "{$argument->getKeyName()}:{$argument->getKey()}",
            get_class($argument)
        );
    }
}
