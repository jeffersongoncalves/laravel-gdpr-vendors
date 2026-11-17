<?php

namespace JeffersonGoncalves\GdprVendors;

use JeffersonGoncalves\GdprVendors\Commands\VendorsCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GdprVendorsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('gdpr-vendors')
            ->hasConfigFile()
            ->hasMigrations(['create_gdpr_vendors_table'])
            ->hasCommand(VendorsCommand::class);
    }
}
