<?php

namespace App\Providers\Filament;

use App\Filament\Auth\Login;
use Awcodes\Curator\CuratorPlugin;
use Exception;
use Filament\FontProviders\GoogleFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentIcon;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id(id: 'admin')
            ->path(path: 'admin')
            ->login(action: Login::class)
            ->passwordReset()
            ->profile(isSimple: false)
            ->colors([
                'primary' => Color::Sky,
                'gray' => Color::Slate,
            ])
            ->favicon(asset('favicon.svg'))
            ->brandLogo(fn () => view('filament.admin.logo'))
            ->brandLogoHeight('auto')
            ->sidebarWidth('17rem')
            ->sidebarCollapsibleOnDesktop()
            ->font(family: 'Inter', provider: GoogleFontProvider::class)
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->navigationItems([
                NavigationItem::make('View Site')
                    ->sort(-1)
                    ->icon('heroicon-o-globe-alt')
                    ->url(config('app.url'), shouldOpenInNewTab: true),
            ])
            ->renderHook(
                name: PanelsRenderHook::STYLES_BEFORE,
                hook: fn (): string => Blade::render('components.fonts')
            )
            ->renderHook(
                name: 'panels::scripts.after',
                hook: fn (): string => new HtmlString('<script>document.addEventListener("click", function(e) {if (e?.target?.closest("li")?.classList.contains("fi-pagination-item")){setTimeout(() => window.scrollTo({top: 0, behavior: "smooth"}), 300);}});</script>')
            )
            ->plugins([
                CuratorPlugin::make(),
            ])
            ->discoverResources(in: app_path(path: 'Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path(path: 'Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path(path: 'Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->bootUsing(function () {
                FilamentIcon::register([
                    'panels::sidebar.expand-button' => 'expand-menu',
                    'panels::sidebar.collapse-button' => 'collapse-menu',
                ]);
            });
    }
}
