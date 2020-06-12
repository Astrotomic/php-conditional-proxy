<?php

namespace Astrotomic\ConditionalProxy;

use Closure;

trait HasConditionalCalls
{
    /**
     * @param mixed $condition
     * @param Closure|null $callback
     *
     * @return static|ConditionalProxy
     */
    public function when($condition, ?Closure $callback = null)
    {
        $condition = (bool)$condition;
        if ($callback === null) {
            return new ConditionalProxy($this, $condition);
        }

        if ($condition) {
            $callback($this);
        }

        return $this;
    }
}
