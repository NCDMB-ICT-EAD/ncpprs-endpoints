<?php

namespace App\Http\Controllers;

use App\Http\Resources\VesselUtilizationResource;
use App\Services\VesselUtilizationService;

class VesselUtilizationController extends BaseController
{
    public function __construct(VesselUtilizationService $vesselUtilizationService) {
        parent::__construct($vesselUtilizationService, 'VesselUtilization', VesselUtilizationResource::class);
    }
}
