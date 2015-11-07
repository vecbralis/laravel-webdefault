<?php

namespace MVsoft\Webdefault\Facades;

use Illuminate\Support\Facades\Facade;

class MVemail extends Facade
{
	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mvemail';
    }
}