<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Client;
use App\Phone;
use App\Group;
use App\Observers\UserObserver;
use App\Observers\ClientObserver;
use App\Observers\PhoneObserver;
use App\Observers\GroupObserver;

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
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        Route::resourceVerbs([
            'create' => 'cadastrar',
            'edit'   => 'editar',
        ]);

        User::observe(UserObserver::class);
        Client::observe(ClientObserver::class);
        Phone::observe(PhoneObserver::class);
        Group::observe(GroupObserver::class);
    }
}
