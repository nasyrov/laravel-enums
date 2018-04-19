<?php

namespace Nasyrov\Laravel\Enums\Tests\Integration;

use Nasyrov\Laravel\Enums\EnumServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            EnumServiceProvider::class,
        ];
    }
}
