<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'role',
        'linkedin',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
