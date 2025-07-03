<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\semester;
use Illuminate\Pagination\Paginator;
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
        $menus = Category::all();
        $semesters = semester::all();
        View::share("menus",$menus);
        View::share("semesters",$semesters);
        Paginator::useBootstrapFive();
    }
}
