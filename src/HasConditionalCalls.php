<?php

namespace Astrotomic\ConditionalProxy;

use Closure;

trait HasConditionalCalls
{
    /**
     * @param mixed $condition
     * @param Closure|null $callback
     *
     * @return ($callback is null ? ConditionalProxy : static)
     */
    public function when($condition, ?Closure $callback = null)
    {
        $condition = (bool) $condition;

        if ($callback === null) {
            return new ConditionalProxy($this, $condition);
        }

        if ($condition) {
            $callback($this);
        }

        return $this;
    }
}
