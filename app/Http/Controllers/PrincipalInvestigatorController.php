<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrincipalInvestigatorResource;
use App\Services\PrincipalInvestigatorService;

class PrincipalInvestigatorController extends BaseController
{
    public function __construct(PrincipalInvestigatorService $principalInvestigatorService) {
        parent::__construct($principalInvestigatorService, 'PrincipalInvestigator', PrincipalInvestigatorResource::class);
    }
}
