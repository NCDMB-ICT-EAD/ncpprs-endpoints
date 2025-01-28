<?php

namespace App\Http\Controllers;

use App\Http\Resources\TrainingResource;
use App\Services\TrainingService;

class TrainingController extends BaseController
{
    public function __construct(TrainingService $trainingService) {
        parent::__construct($trainingService, 'Training', TrainingResource::class);
    }
}
