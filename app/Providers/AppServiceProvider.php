<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();
        Model::shouldBeStrict();

        FilamentColor::register([
            'dominant' => Color::hex('#2F4858'),
            'secondary' => Color::hex('#33658A'),
            'tertiary' => Color::hex('#55DDE0'),
            'accent' => Color::hex('#F6AE2D'),
            'neutral' => Color::Zinc,
        ]);
    }
}
