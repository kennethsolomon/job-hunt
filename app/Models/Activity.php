<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Guava\Calendar\Contracts\Eventable;
use Guava\Calendar\ValueObjects\CalendarEvent;

class Activity extends Model implements Eventable
{
    protected $fillable = [
        'application_id',
        'user_id',
        'type',
        'body',
        'outcome',
        'meta',
        'happened_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'happened_at' => 'datetime',
    ];

    public function toCalendarEvent(): CalendarEvent
    {
        return CalendarEvent::make($this)
            ->title($this->type . ': ' . ($this->body ?? 'Activity'))
            ->start($this->happened_at)
            ->end(Carbon::parse($this->happened_at)->addHour());
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}