<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceTypeResource;
use App\Services\ServiceTypeService;

class ServiceTypeController extends BaseController
{
    public function __construct(ServiceTypeService $serviceTypeService) {
        parent::__construct($serviceTypeService, 'ServiceType', ServiceTypeResource::class);
    }
}
