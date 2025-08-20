<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Application extends Model
{
    protected $fillable = [
        'user_id','company_id','role','source_url','job_description','status',
        'salary_ask','salary_offer','applied_on','next_follow_up_at','meta'
    ];

    protected $casts = [
        'meta' => 'array',
        'applied_on' => 'date',
        'next_follow_up_at' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function company(): BelongsTo { return $this->belongsTo(Company::class); }
    public function activities(): HasMany { return $this->hasMany(Activity::class)->latest('happened_at'); }
    public function interviews(): HasMany { return $this->hasMany(Interview::class)->orderBy('scheduled_at'); }
    public function tasks(): HasMany { return $this->hasMany(Task::class)->orderBy('due_at'); }
    public function tags(): MorphToMany { return $this->morphToMany(Tag::class, 'taggable'); }

    public function scopeActive($q) {
        return $q->whereNotIn('status', ['accepted','rejected','archived']);
    }
}
