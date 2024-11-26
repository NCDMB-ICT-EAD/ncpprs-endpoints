<?php

namespace App\Services;

use App\Repositories\ProcuredMaterialRepository;

class ProcuredMaterialService extends BaseService
{
    public function __construct(ProcuredMaterialRepository $procuredMaterialRepository)
    {
        parent::__construct($procuredMaterialRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'contractor_id' => 'required|integer|exists:companies,id',
            'project_id' => 'required|integer|exists:projects,id',
            'material_type_id' => 'required|integer|exists:material_types,id',
            'item_description' => 'nullable|string|min:5',
            'quantity' => 'required|integer|min:1',
            'unit' => 'nullable|string|max:255',
            'oem_name' => 'nullable|string|max:255',
            'oem_origin' => 'nullable|string|max:255',
            'year' => 'required|integer|digits:4',
            'period' => 'required|string|max:255',
            'nc_value' => 'nullable|numeric|min:0',
            'total_value' => 'nullable|numeric|min:0',
        ];
    }
}
