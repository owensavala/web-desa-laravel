<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\FooterSetting;
use App\Models\ProfilDesa;

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
        // Share footer and basic village settings globally to views
        View::composer('*', function ($view) {
            if (Schema::hasTable('footer_settings') && Schema::hasTable('profil_desa')) {
                $footer = FooterSetting::first();
                $profil = ProfilDesa::first();
                $view->with('globalFooter', $footer)->with('globalProfil', $profil);
            }
        });
    }
}
