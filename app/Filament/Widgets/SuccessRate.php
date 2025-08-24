<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuccessRate extends StatsOverviewWidget
{
    protected static ?int $sort = 2;
    protected function getCards(): array
    {
        $from = now()->subDays(30);
        $to = now();

        $total = Application::where('user_id', auth()->id())
            ->whereBetween('created_at', [$from, $to])->count();

        $offers = Application::where('user_id', auth()->id())
            ->where('status', 'offer')
            ->whereBetween('updated_at', [$from, $to])->count();

        $rate = $total ? round(($offers / $total) * 100, 1) : 0;

        return [
            Stat::make('30‑day Success Rate', "{$rate}%")
                ->description("$offers offers / $total apps")
                ->descriptionIcon('heroicon-o-trophy')
                ->color($rate > 0 ? 'success' : 'gray'),
        ];
    }
}
