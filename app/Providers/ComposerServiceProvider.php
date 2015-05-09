<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

// See "Defining A View Composer": http://laravel.com/docs/5.0/views#view-composers
class ComposerServiceProvider extends ServiceProvider {

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer('app.*', 'App\Http\ViewComposers\AppComposer');
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }

}