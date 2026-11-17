<?php

namespace JeffersonGoncalves\GdprVendors\Tests;

use JeffersonGoncalves\GdprVendors\GdprVendorsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            GdprVendorsServiceProvider::class,
        ];
    }
}
