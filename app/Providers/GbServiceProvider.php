<?php namespace App\Providers;

use App\Services\Shortcut;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class GbServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
    }

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('gb.environment', function($app)
        {
            return new Shortcut($app['request']);
        });
	}

}
