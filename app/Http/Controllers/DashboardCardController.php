<?php

namespace App\Http\Controllers;


use App\Http\Resources\DashboardCardResource;
use App\Services\DashboardCardService;
use Illuminate\Support\Facades\Auth;

class DashboardCardController extends BaseController
{
    public function __construct(DashboardCardService $dashboardCardService) {
        parent::__construct($dashboardCardService, 'DashboardCard', DashboardCardResource::class);
    }
}
