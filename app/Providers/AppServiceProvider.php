<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
	// Use X-Forwarded-Host header to correctly determine base URL
	if (request()->header('X-Forwarded-Proto')) {
	    URL::forceScheme(request()->header('X-Forwarded-Proto'));
	}
	    if (request()->header('X-Forwarded-Host')) {
		    URL::forceRootUrl(request()->header('X-Forwarded-Proto') . '://' . request()->header('X-Forwarded-Host'));
	}
    }
}
