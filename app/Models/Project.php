<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...

    public function contractor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class, 'contractor_id');
    }

    public function rndProjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RNDProject::class, 'project_id');
    }

    public function scopes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectScope::class);
    }

    public function renderedServices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RenderedService::class);
    }

    public function hcds(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Hcd::class);
    }

    public function procuredMaterials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProcuredMaterial::class);
    }
}
