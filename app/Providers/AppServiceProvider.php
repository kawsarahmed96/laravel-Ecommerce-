<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
        //
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        Paginator::useBootstrap();

       $bestSellingPrduct =  OrderDetail::where('id',3)->get();

        View::share('bestSellingPrducts', $bestSellingPrduct);

      

    }
}
