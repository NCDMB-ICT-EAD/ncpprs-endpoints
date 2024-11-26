<?php

namespace App\Http\Controllers;


use App\Http\Resources\HcdResource;
use App\Services\HcdService;

class HcdController extends BaseController
{
    public function __construct(HcdService $hcdService) {
        parent::__construct($hcdService, 'Hcd', HcdResource::class);
    }
}
