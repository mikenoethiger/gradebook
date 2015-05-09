<?php namespace App\Providers;

use App\School;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

// This class was created because the default EventServiceProvider does not work properly,
// even if it is registered in the app.php config file, the boot method is never fired
class GbEventServiceProvider extends ServiceProvider {

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
		//
	}

}
