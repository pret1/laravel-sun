<?php

namespace App\Providers;

use App\Http\Middleware\CustomVerifyCsrfToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['router']->pushMiddlewareToGroup('web', CustomVerifyCsrfToken::class);

        Model::unguard();
        Vite::prefetch(concurrency: 3);
    }
}
