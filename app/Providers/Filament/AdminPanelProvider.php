<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Widgets\DashboardCardVendor;
use App\Filament\Widgets\DashboardOverview;
use App\Filament\Widgets\UsersOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentGeneralSettings\FilamentGeneralSettingsPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id(config('listing.admin_path'))
            ->path(config('listing.admin_path'))
            ->login()
            ->colors([
                'primary' => Color::Cyan,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                DashboardOverview::class,
                UsersOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                \Shipu\WebInstaller\Middleware\RedirectIfNotInstalled::class,
                \App\Http\Middleware\CheckIfAppIsModeTest::class,
                \App\Http\Middleware\ClearCacheEveryUpdate::class,
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
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->plugin(\Filament\SpatieLaravelTranslatablePlugin::make()->defaultLocales(config('language.allowed')))
            ->plugin(\TomatoPHP\FilamentMenus\FilamentMenusPlugin::make())
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->setNavigationLabel('My Profile')
                    ->setNavigationGroup('Account')
                    ->setIcon('heroicon-o-user')
                    ->shouldShowAvatarForm()
                    ->shouldRegisterNavigation(false)
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn () => auth()->user()->name)
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle')
                    //If you are using tenancy need to check with the visible method where ->company() is the relation between the user and tenancy model as you called
                    ->visible(function (): bool {
                        return true;
                    }),
            ])
            ->plugin(
                \TomatoPHP\FilamentTranslations\FilamentTranslationsPlugin::make()
                    ->allowClearTranslations()
                    ->allowClearTranslations()
            )
            ->plugin(\TomatoPHP\FilamentTranslations\FilamentTranslationsSwitcherPlugin::make())
            ->plugin(FilamentGeneralSettingsPlugin::make()
                ->canAccess(fn () => auth()->user()->can('manage general setting'))
                ->setSort(2)
                ->setIcon('heroicon-o-cog')
                ->setNavigationGroup('Settings')
                ->setTitle('General')
                ->setNavigationLabel('General'))
            ->path(config('listing.admin_path'));
    }
}
