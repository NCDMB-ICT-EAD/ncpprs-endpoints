<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifSubmissionResource;
use App\Services\LifSubmissionService;

class LifSubmissionController extends BaseController
{
    public function __construct(LifSubmissionService $lifSubmissionService) {
        parent::__construct($lifSubmissionService, 'LIF Submission', LifSubmissionResource::class);
    }
}
