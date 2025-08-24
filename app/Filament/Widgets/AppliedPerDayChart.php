<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;

class AppliedPerDayChart extends ChartWidget
{
    protected ?string $heading = 'Applications per day (14d)';
    protected static ?int $sort = 3;


    protected function getData(): array
    {
        $period = CarbonPeriod::create(now()->subDays(13)->startOfDay(), now()->startOfDay());
        $labels = [];
        $values = [];

        foreach ($period as $day) {
            $labels[] = $day->format('M d');
            $values[] = Application::where('user_id', auth()->id())
                ->whereDate('applied_on', $day)->count();
        }

        return ['datasets' => [['label' => 'Applied', 'data' => $values]], 'labels' => $labels];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
