<?php

namespace Nasyrov\Laravel\Enums\Console;

use Illuminate\Support\Facades\Artisan;
use Nasyrov\Laravel\Enums\Tests\Integration\TestCase;

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
