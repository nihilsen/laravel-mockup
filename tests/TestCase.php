<?php

namespace Nihilsen\LaravelMockup\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nihilsen\LaravelMockup\LaravelMockupServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Nihilsen\\LaravelMockup\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelMockupServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-mockup_table.php.stub';
        $migration->up();
        */
    }
}
