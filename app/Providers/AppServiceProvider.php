<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Barryvdh\DomPDF\ServiceProvider as DomPDFServiceProvider;
use Illuminate\Foundation\AliasLoader;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(DomPDFServiceProvider::class);
    }

    public function boot(): void
    {
        AliasLoader::getInstance()->alias('PDF', \Barryvdh\DomPDF\Facade\Pdf::class);
    }
}
