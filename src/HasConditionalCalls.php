<?php

namespace Astrotomic\ConditionalProxy;

use Closure;

trait HasConditionalCalls
{
    /**
     * @param bool $condition
     * @param Closure|null $callback
     *
     * @return static|ConditionalProxy
     */
    public function when(bool $condition, ?Closure $callback = null)
    {
        if ($callback === null) {
            return new ConditionalProxy($this, $condition);
        }

        if ($condition) {
            $callback($this);
        }

        return $this;
    }
}
