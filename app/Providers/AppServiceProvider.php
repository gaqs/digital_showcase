<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\Models\UserProfile;

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
        //muestra en todas las vistas de profile, el banner y el avatar
        View::composer(['web.sections.profile.*'], function ($view) {
            $user = Auth::user();
            if($user) {
                $profile = UserProfile::where('user_id', $user->id)->first();
                $view->with('avatar', $profile->avatar ?? null);
                $view->with('banner', $profile->banner ?? null);
            }
        });
    }
}
