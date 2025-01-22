<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectSubmissionResource;
use App\Services\ProjectSubmissionService;

class ProjectSubmissionController extends BaseController
{
    public function __construct(ProjectSubmissionService $projectSubmissionService) {
        parent::__construct($projectSubmissionService, 'Project Submission', ProjectSubmissionResource::class);
    }
}
