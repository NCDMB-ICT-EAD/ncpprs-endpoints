<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCategory extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...

    public function trainings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Training::class);
    }
}
