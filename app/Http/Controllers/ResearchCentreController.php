<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchCentreResource;
use App\Services\ResearchCentreService;

class ResearchCentreController extends BaseController
{
    public function __construct(ResearchCentreService $researchCentreService) {
        parent::__construct($researchCentreService, 'ResearchCentre', ResearchCentreResource::class);
    }
}
