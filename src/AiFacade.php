<?php

namespace Devdojo\Ai;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Devdojo\Ai\Skeleton\SkeletonClass
 */
class AiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ai';
    }
}
