<?php

namespace Nasyrov\Laravel\Enum;

use Illuminate\Support\ServiceProvider;
use Nasyrov\Laravel\Enum\Console\EnumMakeCommand;

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
