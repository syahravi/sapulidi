<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use Filament\Support\Colors\Color;
use Filament\Widgets; // Pastikan ini di-import
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\MenuItem;

// Import widget kustom yang akan kita buat
use App\Filament\Widgets\AppStatsOverview;
use App\Filament\Widgets\IncomingWasteChart;
use App\Filament\Widgets\RevenueChart;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Green,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class, // Tetap gunakan dashboard bawaan Filament
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // // Daftarkan widget kustom Anda di sini
                AppStatsOverview::class,    // Widget untuk statistik ringkasan
                IncomingWasteChart::class,  // Widget untuk grafik sampah masuk
                RevenueChart::class,        // Widget untuk grafik pendapatan
                Widgets\AccountWidget::class,     // Opsional: hapus jika tidak ingin menampilkan
                Widgets\FilamentInfoWidget::class, // Opsional: hapus jika tidak ingin menampilkan
            ])
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
            ->plugin(FilamentSpatieRolesPermissionsPlugin::make())
            ->profile();
    }

    public function boot(): void
    {
        MenuItem::make()
            ->label('Edit Profil Saya')
            ->url(fn (): string => route('filament.admin.pages.profile'))
            ->icon('heroicon-o-user-circle');
    }
}
