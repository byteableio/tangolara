<?php

namespace Byteable\Tangolara\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Tango extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TangoService';
    }
}
