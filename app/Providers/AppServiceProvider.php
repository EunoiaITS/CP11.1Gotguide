<?php

namespace App\Providers;

use App\UserPayments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $myOffer = '';
            if(auth()->check()){
                if(auth()->user()->role == 'agent'){
                    $myOffer = UserPayments::where('user_id', auth()->user()->id)->first();
                }
            }
            $view->with('myOffer', $myOffer);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment() == 'local'){
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
