<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Vehicle;
use App\Models\User;

class ViewAuthorizedVehicles extends StatsOverviewWidget
{
    /**
     * Define the widget cards.
     */
    protected function getCards(): array
    {
        return [
            Card::make(
                'Authorized Vehicles',
                Vehicle::whereIn(
                    'fk_owner_id',
                    User::where('status', 'approved')->pluck('pk_id')
                )
                ->where('fk_owner_model', User::class)
                ->count()
            )
            ->description('Total vehicles owned by approved users')
            ->color('success'), // Green color for approved users
        ];
    }
}
