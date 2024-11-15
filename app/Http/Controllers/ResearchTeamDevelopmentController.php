<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchTeamDevelopmentResource;
use App\Services\ResearchTeamDevelopmentService;

class ResearchTeamDevelopmentController extends BaseController
{
    public function __construct(ResearchTeamDevelopmentService $researchTeamDevelopmentService) {
        parent::__construct($researchTeamDevelopmentService, 'ResearchTeamDevelopment', ResearchTeamDevelopmentResource::class);
    }
}
