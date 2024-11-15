<?php

namespace App\Http\Controllers;

use App\Http\Resources\VesselResource;
use App\Services\VesselService;

class VesselController extends BaseController
{
    public function __construct(VesselService $vesselService) {
        parent::__construct($vesselService, 'Vessel', VesselResource::class);
    }
}
