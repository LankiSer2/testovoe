<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        if (! is_dir($modulesPath)) {
            return;
        }

        $finder = Finder::create()
            ->files()
            ->in($modulesPath)
            ->path('Routes')
            ->name('api.php');

        foreach ($finder as $file) {
            Route::middleware('api')
                ->prefix('api')
                ->group($file->getRealPath());
        }
    }
}
