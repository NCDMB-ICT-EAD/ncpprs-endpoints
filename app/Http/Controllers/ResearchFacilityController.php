<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchFacilityResource;
use App\Services\ResearchFacilityService;

class ResearchFacilityController extends BaseController
{
    public function __construct(ResearchFacilityService $researchFacilityService) {
        parent::__construct($researchFacilityService, 'ResearchFacility', ResearchFacilityResource::class);
    }
}
