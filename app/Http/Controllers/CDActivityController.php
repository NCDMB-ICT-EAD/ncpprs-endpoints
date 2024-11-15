<?php

namespace App\Http\Controllers;

use App\Http\Resources\CDActivityResource;
use App\Services\CDActivityService;

class CDActivityController extends BaseController
{
    public function __construct(CDActivityService $cDActivityService) {
        parent::__construct($cDActivityService, 'CDActivity', CDActivityResource::class);
    }
}
