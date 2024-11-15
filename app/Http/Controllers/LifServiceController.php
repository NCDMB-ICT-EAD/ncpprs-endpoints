<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifServiceResource;
use App\Services\LifServiceService;

class LifServiceController extends BaseController
{
    public function __construct(LifServiceService $lifServiceService) {
        parent::__construct($lifServiceService, 'LifService', LifServiceResource::class);
    }
}
