<?php

namespace App\Services;

use App\Repositories\RenderedServiceRepository;

class RenderedServiceService extends BaseService
{
    public function __construct(RenderedServiceRepository $renderedServiceRepository)
    {
        parent::__construct($renderedServiceRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'contractor_id' => 'required|integer|exists:companies,id',
            'service_type_id' => 'required|integer|exists:service_types,id',
            'service_description' => 'nullable|string|min:5',
            'year' => 'required|integer|digits:4',
            'period' => 'required|string|max:255',
            'nc_value' => 'nullable|numeric|min:0',
            'total_value' => 'nullable|numeric|min:0',
        ];
    }
}
