<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrainingCategoryResource;
use App\Services\TrainingCategoryService;

class TrainingCategoryController extends BaseController
{
    public function __construct(TrainingCategoryService $trainingCategoryService) {
        parent::__construct($trainingCategoryService, 'Training Category', TrainingCategoryResource::class);
    }
}
