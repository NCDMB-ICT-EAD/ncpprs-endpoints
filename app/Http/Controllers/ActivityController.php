<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Services\ActivityService;

class ActivityController extends BaseController
{
    public function __construct(ActivityService $activityService) {
        parent::__construct($activityService, 'Activity', ActivityResource::class);
    }
}
