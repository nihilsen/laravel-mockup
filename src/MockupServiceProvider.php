<?php

namespace Nihilsen\LaravelMockup;

use Illuminate\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MockupServiceProvider extends PackageServiceProvider
{
    /**
     * The mockup classes.
     *
     * @var class-string[]
     */
    protected static array $mockupClasses;

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-mockup')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->bind(Mockup::class, function (Application $app) {
            try {
                return $app->build(Mockup::class);
            } catch (\Throwable $th) {
                return (new \ReflectionClass(Mockup::class))->newInstanceWithoutConstructor();
            }
        });
    }
}
