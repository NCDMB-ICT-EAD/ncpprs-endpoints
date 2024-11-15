<?php

namespace App\Http\Controllers;

use App\Http\Resources\RenderedServiceResource;
use App\Services\RenderedServiceService;

class RenderedServiceController extends BaseController
{
    public function __construct(RenderedServiceService $renderedServiceService) {
        parent::__construct($renderedServiceService, 'RenderedService', RenderedServiceResource::class);
    }
}
