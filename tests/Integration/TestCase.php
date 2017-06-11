<?php

namespace Nasyrov\Laravel\Enum\Tests\Integration;

use Nasyrov\Laravel\Enum\EnumServiceProvider;
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
            ImgixServiceProvider::class,
        ];
    }
}
