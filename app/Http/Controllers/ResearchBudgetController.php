<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchBudgetResource;
use App\Services\ResearchBudgetService;

class ResearchBudgetController extends BaseController
{
    public function __construct(ResearchBudgetService $researchBudgetService) {
        parent::__construct($researchBudgetService, 'ResearchBudget', ResearchBudgetResource::class);
    }
}
