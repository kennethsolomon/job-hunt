<?php
namespace App\Services;

use App\Models\{Application, Activity};

class ApplicationStatusService {
    public static function move(Application $app, string $to): void {
        $from = $app->status;
        $nextFollow = $to === 'applied' ? now()->addDays(3) : null;

        $app->update([
            'status' => $to,
            'next_follow_up_at' => $nextFollow,
        ]);

        Activity::create([
            'application_id' => $app->id,
            'user_id' => $app->user_id,
            'type' => 'status_change',
            'body' => "$from → $to",
            'meta' => ['from'=>$from,'to'=>$to],
            'happened_at' => now(),
        ]);
    }
}