<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacityBuildingActivity extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...
    public function capacityBuilding(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CapacityBuilding::class);
    }
}
