<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifInstitution extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...
    public function lifActivities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LifActivity::class);
    }
}
