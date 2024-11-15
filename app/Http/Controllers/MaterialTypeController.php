<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialTypeResource;
use App\Services\MaterialTypeService;

class MaterialTypeController extends BaseController
{
    public function __construct(MaterialTypeService $materialTypeService) {
        parent::__construct($materialTypeService, 'MaterialType', MaterialTypeResource::class);
    }
}
