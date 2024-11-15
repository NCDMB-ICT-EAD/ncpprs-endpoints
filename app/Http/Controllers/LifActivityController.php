<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifActivityResource;
use App\Services\LifActivityService;

class LifActivityController extends BaseController
{
    public function __construct(LifActivityService $lifActivityService) {
        parent::__construct($lifActivityService, 'LifActivity', LifActivityResource::class);
    }
}
