<?php

namespace App\Http\Controllers;


use App\Http\Resources\CapacityBuildingActivityResource;
use App\Services\CapacityBuildingActivityService;

class CapacityBuildingActivityController extends BaseController
{
    public function __construct(CapacityBuildingActivityService $capacityBuildingActivityService) {
        parent::__construct($capacityBuildingActivityService, 'CapacityBuildingActivity', CapacityBuildingActivityResource::class);
    }
}
