<?php
namespace App\Filament\Custom;

class Dashboard extends \Filament\Pages\Dashboard
{
    public static function canAccess(): bool
    {
        return auth()->user()->isSeller() || auth()->user()->isSuperAdmin();
    }

}
