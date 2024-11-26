<?php

namespace App\Http\Controllers;


use App\Http\Resources\HcdActivityResource;
use App\Services\HcdActivityService;

class HcdActivityController extends BaseController
{
    public function __construct(HcdActivityService $hcdActivityService) {
        parent::__construct($hcdActivityService, 'HcdActivity', HcdActivityResource::class);
    }
}
