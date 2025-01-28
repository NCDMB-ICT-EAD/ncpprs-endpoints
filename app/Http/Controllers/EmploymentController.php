<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmploymentResource;
use App\Services\EmploymentService;

class EmploymentController extends BaseController
{
    public function __construct(EmploymentService $employmentService) {
        parent::__construct($employmentService, 'Employment', EmploymentResource::class);
    }
}
