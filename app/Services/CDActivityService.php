<?php

namespace App\Services;

use App\Repositories\CDActivityRepository;

class CDActivityService extends BaseService
{
    public function __construct(CDActivityRepository $cDActivityRepository)
    {
        parent::__construct($cDActivityRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
