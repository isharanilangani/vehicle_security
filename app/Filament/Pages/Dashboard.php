<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;
use App\Filament\Widgets\ViewPendingUsers;
/*use App\Filament\Widgets\ApproveUsers;
use App\Filament\Widgets\CreateAuthorizedVehicle;
use App\Filament\Widgets\EditAuthorizedVehicle;
use App\Filament\Widgets\DeleteAuthorizedVehicle;
use App\Filament\Widgets\CreateUnauthorizedVehicle;
use App\Filament\Widgets\EditUnauthorizedVehicle;
use App\Filament\Widgets\DeleteUnauthorizedVehicle;
use App\Filament\Widgets\RegisterOwnVehicle;
use App\Filament\Widgets\EditOwnVehicle;
use App\Filament\Widgets\DeleteOwnVehicle;
use App\Filament\Widgets\MonthlyReports;
use App\Filament\Widgets\ViewAuthorizedVehicles;
use App\Filament\Widgets\ViewOwnVehicle;
use App\Filament\Widgets\ViewUnauthorizedVehicles;*/

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        $user = Auth::user();
        $widgets = [];

        if ($user->hasRole('admin')) {
            $widgets = [
                ViewPendingUsers::class,
                /*ApproveUsers::class,
                CreateAuthorizedVehicle::class,
                EditAuthorizedVehicle::class,
                DeleteAuthorizedVehicle::class,
                ViewAuthorizedVehicles::class,
                CreateUnauthorizedVehicle::class,
                EditUnauthorizedVehicle::class,
                DeleteUnauthorizedVehicle::class,
                ViewUnauthorizedVehicles::class,
                MonthlyReports::class,*/
            ];
        } elseif ($user->hasRole('security_personnel')) {
            $widgets = [
                /*ViewAuthorizedVehicles::class,
                ViewUnauthorizedVehicles::class,
                CreateUnauthorizedVehicle::class,
                EditUnauthorizedVehicle::class,*/
            ];
        } elseif ($user->hasRole('vehicle_owner')) {
            $widgets = [
                /*RegisterOwnVehicle::class,
                EditOwnVehicle::class,
                DeleteOwnVehicle::class,
                ViewOwnVehicle::class,*/
            ];
        }

        return $widgets;
    }
}
