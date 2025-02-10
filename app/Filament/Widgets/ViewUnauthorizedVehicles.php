<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Vehicle;
use App\Models\Guest; // Assuming you have a Guest model

class ViewUnauthorizedVehicles extends StatsOverviewWidget
{
    /**
     * Define the widget cards.
     */
    protected function getCards(): array
    {
        return [
            Card::make('Unauthorized Vehicles', Vehicle::whereIn('fk_owner_model', [Guest::class])
                ->count()) // Count vehicles where the owner is a guest
                ->description('Total vehicles owned by unauthorized guests')
                ->color('danger'), // Use danger color (red) to indicate unauthorized status
        ];
    }
}
