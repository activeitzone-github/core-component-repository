<?php

namespace MehediIitdu\CoreComponentRepository;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MehediIitdu\CoreComponentRepository\Skeleton\SkeletonClass
 */
class CoreComponentRepositoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'core-component-repository';
    }
}
