<?php

namespace App\Jobs;

use App\Models\Application;
use App\Models\Task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GenerateFollowUpsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Application::active()
            ->whereNotNull('next_follow_up_at')
            ->where('next_follow_up_at','<=', now())
            ->chunkById(200, function($batch){
                foreach ($batch as $app) {
                    Task::firstOrCreate([
                        'user_id' => $app->user_id,
                        'application_id' => $app->id,
                        'title' => "Follow up: {$app->role} @ {$app->company?->name}",
                        'due_at' => $app->next_follow_up_at,
                    ]);
                }
            });
    }
}
