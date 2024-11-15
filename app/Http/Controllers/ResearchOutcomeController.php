<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchOutcomeResource;
use App\Services\ResearchOutcomeService;

class ResearchOutcomeController extends BaseController
{
    public function __construct(ResearchOutcomeService $researchOutcomeService) {
        parent::__construct($researchOutcomeService, 'ResearchOutcome', ResearchOutcomeResource::class);
    }
}
