<?php

namespace App\Mail;

use App\Models\{User, Interview, Task, Application};
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyDigest extends Mailable
{
    use Queueable, SerializesModels;

    public Collection $tomorrowInterviews;
    public Collection $overdueTasks;
    public User $user;
    public int $totalApplications;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->loadDigestData();
    }

    private function loadDigestData(): void
    {
        $tomorrow = now('Asia/Manila')->addDay();
        $tomorrowStart = $tomorrow->startOfDay();
        $tomorrowEnd = $tomorrow->endOfDay();

        // Tomorrow's interviews
        $this->tomorrowInterviews = Interview::whereHas('application', function($query) {
                $query->where('user_id', $this->user->id);
            })
            ->whereBetween('scheduled_at', [$tomorrowStart, $tomorrowEnd])
            ->with(['application.company'])
            ->orderBy('scheduled_at')
            ->get();

        // Overdue tasks
        $this->overdueTasks = Task::where('user_id', $this->user->id)
            ->whereNull('completed_at')
            ->where('due_at', '<=', now('Asia/Manila'))
            ->with(['application.company'])
            ->orderBy('due_at')
            ->get();

        // Total applications for context
        $this->totalApplications = Application::where('user_id', $this->user->id)->count();
    }

    public function envelope(): Envelope
    {
        $interviewCount = $this->tomorrowInterviews->count();
        $overdueCount = $this->overdueTasks->count();

        $subject = '📅 Daily Job Hunt Digest';

        if ($interviewCount > 0) {
            $subject .= " • {$interviewCount} Interview" . ($interviewCount > 1 ? 's' : '') . ' Tomorrow';
        }

        if ($overdueCount > 0) {
            $subject .= " • {$overdueCount} Overdue";
        }

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.daily-digest');
    }

    public function hasContent(): bool
    {
        return $this->tomorrowInterviews->isNotEmpty() || $this->overdueTasks->isNotEmpty();
    }
}