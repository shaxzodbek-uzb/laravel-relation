<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        $this->app->singleton(Manager::class, function(){
            
            $manager = new Manager();
            $manager->parseIncludes(request()->get('includes', ''));

            $manager->setSerializer(new JsonApiSerializer());
            return $manager;
        });
    }
}
