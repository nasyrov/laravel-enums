<?php

namespace Nasyrov\Laravel\Enums;

use Illuminate\Support\ServiceProvider;
use Nasyrov\Laravel\Enums\Console\EnumMakeCommand;

class EnumServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->commands([
            EnumMakeCommand::class,
        ]);
    }
}
