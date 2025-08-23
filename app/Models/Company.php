<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = ['user_id','name','website','location'];

    public function contacts(): HasMany { return $this->hasMany(Contact::class); }
    public function applications(): HasMany { return $this->hasMany(Application::class); }
}
