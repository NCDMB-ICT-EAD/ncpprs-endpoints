<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifActivity extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...
    public function lifInstitution(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LifInstitution::class, 'lif_institution_id');
    }

    public function lifService(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LifService::class, 'lif_service_id');
    }

    public function contractor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class, 'contractor_id');
    }

    public function broker(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Broker::class, 'broker_id');
    }
}
