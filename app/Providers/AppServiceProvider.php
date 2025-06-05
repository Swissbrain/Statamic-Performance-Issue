<?php

namespace App\Providers;

use App\Services\MakarisService;
use App\View\CssClassBuilder;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Statamic\Events\Event;
use Statamic\Statamic;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Makaris', MakarisService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Statamic::vite('app', [
             'resources/js/cp.js',
             'resources/css/cp.css',
         ]);
        // if in prod force https
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        LogViewer::auth(function () {
            return auth()->check() && auth()->user()->super;
        });
    }
}
