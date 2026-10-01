<?php

namespace App\Providers;

use App\Models\ProfilMasjid;
use Illuminate\Support\Facades\Schema;
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
        View::composer('layouts.app', function ($view) {
            $faviconPath = Schema::hasColumn('profil_masjid', 'favicon')
                ? ProfilMasjid::value('favicon')
                : null;

            $view->with('faviconPath', $faviconPath);
        });
    }
}
