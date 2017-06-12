<?php

namespace Nasyrov\Laravel\Enum\Console;

use Illuminate\Support\Facades\Artisan;
use Nasyrov\Laravel\Enum\Tests\Integration\TestCase;

class EnumMakeCommandTest extends TestCase
{
    /** @test */
    public function it_can_run_the_command()
    {
        $exitCode = Artisan::call('make:enum', ['name' => 'TestEnum']);

        $this->assertEquals(0, $exitCode);
        $this->assertContains('Enum created successfully', Artisan::output());
    }
}
