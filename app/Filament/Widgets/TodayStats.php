<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\{Application, Activity, Interview, Task};

class TodayStats extends StatsOverviewWidget
{
    protected static ?int $sort = 3;


    protected function getStats(): array
    {
        $tzNow = now('Asia/Manila');

        $appliedToday = Application::where('user_id', auth()->id())
            ->whereDate('applied_on', $tzNow)->count();

        $repliesToday = Activity::where('user_id', auth()->id())
            ->where('type','status_change')
            ->whereDate('happened_at', $tzNow)
            ->where('meta->to','replied')->count();

        $interviewsToday = Interview::whereHas('application', fn($q)=>$q->where('user_id',auth()->id()))
            ->whereDate('scheduled_at', $tzNow)->count();

        $overdue = Task::where('user_id', auth()->id())
            ->whereNull('completed_at')
            ->where('due_at','<=', now())->count();

        return [
            Stat::make('Applied Today', $appliedToday)
                ->description('Job applications submitted today')
                ->descriptionIcon('heroicon-o-paper-airplane')
                ->icon('heroicon-o-briefcase')
                ->color('primary'),

            Stat::make('Replies Today', $repliesToday)
                ->description('Companies that responded today')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right')
                ->icon('heroicon-o-envelope')
                ->color($repliesToday > 0 ? 'success' : 'gray'),

            Stat::make('Interviews Today', $interviewsToday)
                ->description('Scheduled interviews for today')
                ->descriptionIcon('heroicon-o-calendar-days')
                ->icon('heroicon-o-user-group')
                ->color($interviewsToday > 0 ? 'warning' : 'gray'),

            Stat::make('Overdue Follow-ups', $overdue)
                ->description($overdue > 0 ? 'Tasks requiring immediate attention' : 'All follow-ups are on track')
                ->descriptionIcon($overdue > 0 ? 'heroicon-o-exclamation-triangle' : 'heroicon-o-check-circle')
                ->icon('heroicon-o-clock')
                ->color($overdue ? 'danger' : 'success'),
        ];
    }

    protected ?string $maxHeight = '300px';
}
