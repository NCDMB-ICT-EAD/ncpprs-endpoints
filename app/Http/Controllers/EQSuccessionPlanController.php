<?php

namespace App\Http\Controllers;

use App\Http\Resources\EQSuccessionPlanResource;
use App\Services\EQSuccessionPlanService;

class EQSuccessionPlanController extends BaseController
{
    public function __construct(EQSuccessionPlanService $eQSuccessionPlanService) {
        parent::__construct($eQSuccessionPlanService, 'EQSuccessionPlan', EQSuccessionPlanResource::class);
    }
}
