<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProcuredMaterialResource;
use App\Services\ProcuredMaterialService;

class ProcuredMaterialController extends BaseController
{
    public function __construct(ProcuredMaterialService $procuredMaterialService) {
        parent::__construct($procuredMaterialService, 'ProcuredMaterial', ProcuredMaterialResource::class);
    }
}
