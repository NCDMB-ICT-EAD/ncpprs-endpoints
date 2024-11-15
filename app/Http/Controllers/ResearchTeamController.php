<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchTeamResource;
use App\Services\ResearchTeamService;

class ResearchTeamController extends BaseController
{
    public function __construct(ResearchTeamService $researchTeamService) {
        parent::__construct($researchTeamService, 'ResearchTeam', ResearchTeamResource::class);
    }
}
