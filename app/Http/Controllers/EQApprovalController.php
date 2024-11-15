<?php

namespace App\Http\Controllers;

use App\Http\Resources\EQApprovalResource;
use App\Services\EQApprovalService;

class EQApprovalController extends BaseController
{
    public function __construct(EQApprovalService $eQApprovalService) {
        parent::__construct($eQApprovalService, 'EQApproval', EQApprovalResource::class);
    }
}
