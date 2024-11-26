<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...

    public function scopes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectScope::class);
    }

    public function hcds(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Hcd::class);
    }

    public function activities(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Activity::class, ProjectScope::class);
    }
}
