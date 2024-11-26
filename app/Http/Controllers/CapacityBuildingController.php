<?php

namespace App\Http\Controllers;


use App\Http\Resources\CapacityBuildingResource;
use App\Services\CapacityBuildingService;

class CapacityBuildingController extends BaseController
{
    public function __construct(CapacityBuildingService $capacityBuildingService) {
        parent::__construct($capacityBuildingService, 'CapacityBuilding', CapacityBuildingResource::class);
    }

    public function cdis(): \Illuminate\Http\JsonResponse
    {
        return $this->success($this->jsonResource::collection($this->service->cdis()));
    }

    public function hcds(): \Illuminate\Http\JsonResponse
    {
        return $this->success($this->jsonResource::collection($this->service->hcds()));
    }
}
