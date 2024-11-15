<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifInstitutionServiceResource;
use App\Services\LifInstitutionServiceService;

class LifInstitutionServiceController extends BaseController
{
    public function __construct(LifInstitutionServiceService $lifInstitutionServiceService) {
        parent::__construct($lifInstitutionServiceService, 'LifInstitutionService', LifInstitutionServiceResource::class);
    }
}
