<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifInstitutionResource;
use App\Services\LifInstitutionService;

class LifInstitutionController extends BaseController
{
    public function __construct(LifInstitutionService $lifInstitutionService) {
        parent::__construct($lifInstitutionService, 'LifInstitution', LifInstitutionResource::class);
    }
}
