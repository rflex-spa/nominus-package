<?php

namespace RFlex;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RFlex\Nominus\Skeleton\SkeletonClass
 */
class NominusFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nominus';
    }
}
