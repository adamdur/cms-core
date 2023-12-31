<?php

declare(strict_types=1);

namespace Tests;

use Hash;

trait CreatesApplication
{
    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate', ['--database' => 'sqlite']);
        $this->loadLaravelMigrations(['--database' => 'sqlite']);
        $this->withFactories(__DIR__ . '/factories');
    }

    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = parent::createApplication();

        Hash::setRounds(4);

        return $app;
    }

    protected function getPackageProviders($app)
    {
        return ['Package\ServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Facade' => 'Package\Facade',
        ];
    }
}
