<?php

namespace JeffersonGoncalves\GdprVendors\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\GdprVendors\GdprVendors
 */
class GdprVendors extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-gdpr-vendors';
    }
}
