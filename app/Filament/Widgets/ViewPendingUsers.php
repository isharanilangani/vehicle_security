<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;

class ViewPendingUsers extends StatsOverviewWidget
{
    /**
     * Define the widget cards.
     */
    protected function getCards(): array
    {
        return [
            Card::make('Pending Users', User::where('status', 'pending')->count())
                ->description('Total pending users')
                ->color('warning'), // Use warning color (yellow) to indicate pending status
        ];
    }
}
