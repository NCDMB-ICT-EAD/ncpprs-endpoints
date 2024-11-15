<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoardProjectUtilizationResource;
use App\Services\BoardProjectUtilizationService;

class BoardProjectUtilizationController extends BaseController
{
    public function __construct(BoardProjectUtilizationService $boardProjectUtilizationService) {
        parent::__construct($boardProjectUtilizationService, 'BoardProjectUtilization', BoardProjectUtilizationResource::class);
    }
}
