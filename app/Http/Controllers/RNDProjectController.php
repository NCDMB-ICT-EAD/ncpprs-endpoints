<?php

namespace App\Http\Controllers;

use App\Http\Resources\RNDProjectResource;
use App\Services\RNDProjectService;

class RNDProjectController extends BaseController
{
    public function __construct(RNDProjectService $rNDProjectService) {
        parent::__construct($rNDProjectService, 'RNDProject', RNDProjectResource::class);
    }
}
