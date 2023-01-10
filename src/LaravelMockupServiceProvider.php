<?php

namespace Nihilsen\LaravelMockup;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Nihilsen\LaravelMockup\Commands\LaravelMockupCommand;

class LaravelMockupServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-mockup')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-mockup_table')
            ->hasCommand(LaravelMockupCommand::class);
    }
}
