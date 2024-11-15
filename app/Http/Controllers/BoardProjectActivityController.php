<?php

namespace App\Http\Controllers;

use App\Http\Resources\BoardProjectActivityResource;
use App\Services\BoardProjectActivityService;

class BoardProjectActivityController extends BaseController
{
    public function __construct(BoardProjectActivityService $boardProjectActivityService) {
        parent::__construct($boardProjectActivityService, 'Board Project Activity', BoardProjectActivityResource::class);
    }
}
