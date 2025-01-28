<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifSubmission extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function lifService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LifService::class);
    }

    public function lifActivities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LifActivity::class);
    }
}
