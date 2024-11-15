<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectScopeResource;
use App\Services\ProjectScopeService;

class ProjectScopeController extends BaseController
{
    public function __construct(ProjectScopeService $projectScopeService) {
        parent::__construct($projectScopeService, 'ProjectScope', ProjectScopeResource::class);
    }
}
