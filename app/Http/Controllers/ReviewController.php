<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;

class ReviewController extends BaseController
{
    public function __construct(ReviewService $reviewService) {
        parent::__construct($reviewService, 'Review', ReviewResource::class);
    }
}
