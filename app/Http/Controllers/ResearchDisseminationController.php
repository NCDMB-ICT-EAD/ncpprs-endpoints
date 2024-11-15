<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchDisseminationResource;
use App\Services\ResearchDisseminationService;

class ResearchDisseminationController extends BaseController
{
    public function __construct(ResearchDisseminationService $researchDisseminationService) {
        parent::__construct($researchDisseminationService, 'ResearchDissemination', ResearchDisseminationResource::class);
    }
}
