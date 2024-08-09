<?php

namespace App\Providers\Filament;

use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Widgets\DashboardOverview;
use App\Filament\Widgets\UsersOverview;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
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
            ->plugin(SpatieLaravelTranslatablePlugin::make()
                ->defaultLocales(config('language.allowed')))
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->plugin(
                \RyanChandler\FilamentNavigation\FilamentNavigation::make()
                    ->itemType('Page',[
                        Select::make('page')
                            ->options(\App\Models\Page::select('slug','name')
                                ->Published()
                                ->get()
                                ->mapWithKeys(function ($item) {
                                    return [$item->slug => $item->name];
                                })->toArray())
                            ->required(),
                        ]
                    )
                    ->itemType('Post',[
                            Select::make('post')
                                ->options(\App\Models\Post::select('slug','name')
                                    ->Published()
                                    ->get()
                                    ->mapWithKeys(function ($item) {
                                        return [$item->slug => $item->name];
                                    })->toArray())
                                ->required(),
                        ]
                    )
                    ->withExtraFields([
                        TextInput::make('icon')
                            ->label(__('Icon')),
                        Radio::make('icon_position')
                        ->label(__('Icon Position'))
                        ->options([
                            'left' => __('Left'),
                            'right' => __('Right'),
                        ])
                        ->inline()
                        ->inlineLabel(),
                        Radio::make('authorization')
                            ->label('Authorization')
                            ->options([
                                'guest' => __('Guest'),
                                'auth' => 'Auth',
                                'all' => __('All'),
                            ])
                            ->inline()
                            ->inlineLabel()
                            ->required(),
                        TextInput::make('classes')
                        ->label(__('Classes')),
                        Checkbox::make('divider'),
                    ])
            )
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
            ->plugin(\Kenepa\TranslationManager\TranslationManagerPlugin::make())
            ->plugin(FilamentGeneralSettingsPlugin::make()
                ->canAccess(fn () => auth()->user()->can('manage general setting'))
                ->setSort(2)
                ->setIcon('heroicon-o-cog')
                ->setNavigationGroup('Settings')
                ->setTitle('General')
                ->setNavigationLabel('General'))
            ->path(config('listing.admin_path'))
            ->brandLogo(site_logo())
            ->favicon(site_favicon());
    }
}
