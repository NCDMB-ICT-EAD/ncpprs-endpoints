<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchAccomodationResource;
use App\Services\ResearchAccomodationService;

class ResearchAccomodationController extends BaseController
{
    public function __construct(ResearchAccomodationService $researchAccomodationService) {
        parent::__construct($researchAccomodationService, 'ResearchAccomodation', ResearchAccomodationResource::class);
    }
}
