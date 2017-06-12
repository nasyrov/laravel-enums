<?php

namespace Nasyrov\Laravel\Enum\Tests\Integration;

use Illuminate\Support\Facades\Artisan;
use Nasyrov\Laravel\Enum\Console\EnumMakeCommand;

class EnumServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_command()
    {
        $this->assertInstanceOf(EnumMakeCommand::class, Artisan::all()['make:enum']);
    }
}
