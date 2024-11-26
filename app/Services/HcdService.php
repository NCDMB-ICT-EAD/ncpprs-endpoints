<?php

namespace App\Services;

use App\Repositories\HcdRepository;

class HcdService extends BaseService
{
    public function __construct(HcdRepository $hcdRepository)
    {
        parent::__construct($hcdRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'schedule_id' => 'required|integer|exists:schedules,id',
            'contractor_id' => 'required|integer|exists:companies,id',
            'description' => 'required|string|min:3',
            'planned_man_hrs' => 'required|integer',
            'nc_spend' => 'required|numeric',
            'total_spend' => 'required|numeric',
            'certificate' => 'sometimes|nullable|mimes:pdf',
            'remark' => 'sometimes|nullable|string|min:3',
        ];
    }
}
