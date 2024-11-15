<?php

namespace App\Http\Controllers;

use App\Http\Resources\LifServiceCategoryResource;
use App\Services\LifServiceCategoryService;

class LifServiceCategoryController extends BaseController
{
    public function __construct(LifServiceCategoryService $lifServiceCategoryService) {
        parent::__construct($lifServiceCategoryService, 'LifServiceCategory', LifServiceCategoryResource::class);
    }
}
