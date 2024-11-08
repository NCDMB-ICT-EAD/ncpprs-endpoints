<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialType extends Model
{
    use HasFactory;

    protected $guarded = [''];

    // Model Relationships or Scope Here...
    public function procuredMaterials(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProcuredMaterial::class, 'material_type_id');
    }
}
