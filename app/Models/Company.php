<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...
    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function brokers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Broker::class, 'contractor_id');
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Project::class, 'contractor_id');
    }

    public function boardProjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BoardProject::class, 'contractor_id');
    }

    public function eqApprovals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EQApproval::class, 'contractor_id');
    }

    public function lifActivities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LifActivity::class);
    }

    public function procuredMaterials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProcuredMaterial::class, 'contractor_id');
    }

    public function renderedServices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RenderedService::class, 'contractor_id');
    }

    public function scopes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectScope::class, 'contractor_id');
    }

    public function vendors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Vendor::class, 'contractor_id');
    }

    public function vesselUtilizations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VesselUtilization::class);
    }

    public function hcds(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Hcd::class);
    }
}
