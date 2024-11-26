<?php

namespace App\Services;

use App\Repositories\CapacityBuildingRepository;

class CapacityBuildingService extends BaseService
{
    public function __construct(CapacityBuildingRepository $capacityBuildingRepository)
    {
        parent::__construct($capacityBuildingRepository);
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
            'flag' => 'required|string|max:255|in:hcd,cdi',
        ];
    }

    /**
     * @throws \Exception
     */
    public function cdis()
    {
        return $this->getCollectionByColumn('flag', 'cdi');
    }

    /**
     * @throws \Exception
     */
    public function hcds()
    {
        return $this->getCollectionByColumn('flag', 'hcd');
    }
}
