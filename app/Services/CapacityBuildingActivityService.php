<?php

namespace App\Services;

use App\Repositories\CapacityBuildingActivityRepository;

class CapacityBuildingActivityService extends BaseService
{
    public function __construct(CapacityBuildingActivityRepository $capacityBuildingActivityRepository)
    {
        parent::__construct($capacityBuildingActivityRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'description' => 'required|string|min:3',
            'man_hrs' => 'required|integer|min:1',
            'nc_spend' => 'sometimes|numeric|min:0',
            'total_spend' => 'sometimes|numeric|min:0',
            'year' => 'required|integer|digits:4',
            'period' => 'required|string|max:255',
            'remarks' => 'sometimes|nullable|string|min:3',
            'capacity_building_id' => 'required|integer|exists:capacity_buildings,id',
        ];
    }
}
