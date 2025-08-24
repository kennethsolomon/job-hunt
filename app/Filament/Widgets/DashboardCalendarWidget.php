<?php

namespace App\Filament\Widgets;

use App\Models\Interview;
use App\Models\Task;
use App\Models\Application;
use App\Filament\Resources\Applications\ApplicationResource;
use Guava\Calendar\Filament\CalendarWidget;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Guava\Calendar\ValueObjects\FetchInfo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class DashboardCalendarWidget extends CalendarWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    public function config(): array
    {
        return [
            'initialView' => 'dayGridMonth',
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
            ],
            'firstDay' => 0,
            'height' => 'auto',
            'displayEventTime' => true,
            'eventDisplay' => 'block',
        ];
    }

    protected function getEvents(FetchInfo $info): Collection | array | Builder
    {
        $userId = Auth::id();
        $events = collect();

        // Fetch Upcoming Interviews
        Interview::query()
            ->whereHas('application', fn($q) => $q->where('user_id', $userId))
            ->whereBetween('scheduled_at', [$info->start, $info->end])
            ->where('scheduled_at', '>=', now())
            ->with(['application.company'])
            ->get()
            ->each(function (Interview $interview) use ($events) {
                $events->push(
                    CalendarEvent::make()
                        ->key("interview-{$interview->id}")
                        ->title("🎯 {$interview->application->company->name}")
                        ->start($interview->scheduled_at)
                        ->end($interview->scheduled_at->addHours(1))
                        ->backgroundColor('#3b82f6')
                        ->extendedProp('type', 'interview')
                        ->extendedProp('interview_type', $interview->type)
                        ->extendedProp('location', $interview->location)
                        ->extendedProp('company', $interview->application->company->name)
                        ->extendedProp('role', $interview->application->role)
                        ->url(ApplicationResource::getUrl('edit', ['record' => $interview->application]))
                );
            });

        // Fetch Upcoming Tasks
        Task::query()
            ->where('user_id', $userId)
            ->whereNull('completed_at')
            ->whereBetween('due_at', [$info->start, $info->end])
            ->where('due_at', '>=', now())
            ->with(['application.company'])
            ->get()
            ->each(function (Task $task) use ($events) {
                $title = "📋 {$task->title}";
                $color = '#f59e0b';

                if ($task->due_at->isPast()) {
                    $color = '#ef4444';
                    $title = "⚠️ {$task->title}";
                }

                $events->push(
                    CalendarEvent::make()
                        ->key("task-{$task->id}")
                        ->title($title)
                        ->start($task->due_at)
                        ->end($task->due_at->addMinutes(30))
                        ->backgroundColor($color)
                        ->extendedProp('type', 'task')
                        ->extendedProp('company', $task->application?->company?->name)
                        ->extendedProp('is_overdue', $task->due_at->isPast())
                        ->url($task->application ? ApplicationResource::getUrl('edit', ['record' => $task->application]) : null)
                );
            });

        // Fetch Application Follow-ups
        Application::query()
            ->where('user_id', $userId)
            ->whereNotNull('next_follow_up_at')
            ->whereBetween('next_follow_up_at', [$info->start, $info->end])
            ->where('next_follow_up_at', '>=', now())
            ->with('company')
            ->get()
            ->each(function (Application $application) use ($events) {
                $events->push(
                    CalendarEvent::make()
                        ->key("followup-{$application->id}")
                        ->title("📞 Follow-up: {$application->company->name}")
                        ->start($application->next_follow_up_at)
                        ->end($application->next_follow_up_at->addMinutes(15))
                        ->backgroundColor('#10b981')
                        ->extendedProp('type', 'followup')
                        ->extendedProp('company', $application->company->name)
                        ->extendedProp('role', $application->role)
                        ->extendedProp('status', $application->status)
                        ->url(ApplicationResource::getUrl('edit', ['record' => $application]))
                );
            });

        return $events;
    }

    public function eventContent(): string
    {
        return view('filament.widgets.calendar-event')->render();
    }
}