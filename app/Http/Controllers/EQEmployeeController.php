<?php

namespace App\Http\Controllers;

use App\Http\Resources\EQEmployeeResource;
use App\Services\EQEmployeeService;

class EQEmployeeController extends BaseController
{
    public function __construct(EQEmployeeService $eQEmployeeService) {
        parent::__construct($eQEmployeeService, 'EQEmployee', EQEmployeeResource::class);
    }
}
