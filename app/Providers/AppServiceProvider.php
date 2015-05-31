<?php namespace App\Providers;

use App\Gradebook\Helpers\SubjectFormatter;
use App\Services\GradeJudge;
use App\Services\Round;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
        );

        $this->app->singleton('Round', function ($app) {
            return new Round();
        });
        $this->app->singleton('GradeJudge', function ($app) {
            return new GradeJudge();
        });
        // TODO I'm unsure about singletons. A webserver deals with concurrency. If we include settings this might cause troubles (different settings depending on the context)
        $this->app->singleton('SubjectFormatter', function($app) {
            return new SubjectFormatter($app->make('Round'), $app->make('GradeJudge'));
        });
	}

}
