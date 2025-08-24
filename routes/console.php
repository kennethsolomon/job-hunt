<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Mail\DailyDigest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::job(new \App\Jobs\GenerateFollowUpsJob)->hourly();

// Example daily 7am Manila digest
Schedule::call(function(){
    Log::info('Starting daily digest job...');

    User::chunk(10, function($users) {
        foreach($users as $user) {
            try {
                $digest = new DailyDigest($user);

                // Only send if there's something worth showing
                if($digest->hasContent()) {
                    Mail::to($user->email)->send($digest);
                    Log::info("Daily digest sent to: {$user->email}");
                } else {
                    Log::info("No digest content for: {$user->email}");
                }
            } catch (\Exception $e) {
                Log::error("Failed to send digest to {$user->email}: " . $e->getMessage());
            }
        }
    });

    Log::info('Daily digest job completed.');
})->dailyAt('07:00')->timezone('Asia/Manila');