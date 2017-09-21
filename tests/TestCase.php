<?php

namespace Humweb\Tests\Publishable;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected $runMigrations = true;


    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        // Setup factories
        $this->withFactories(__DIR__.'/resources/factories');

        if ($this->runMigrations === true) {
            app('migrator')->path(__DIR__.'/resources/migrations');
            $this->loadMigrationsFrom([
                '--database' => 'testing'
            ]);
        }
    }


    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

}