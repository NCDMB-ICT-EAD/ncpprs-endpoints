<?php

namespace App\Services;

use App\Repositories\HcdActivityRepository;

class HcdActivityService extends BaseService
{
    public function __construct(HcdActivityRepository $hcdActivityRepository)
    {
        parent::__construct($hcdActivityRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'hcd_id' => 'required|integer|exists:hcds,id',
            'description' => 'required|string|min:3',
            'man_hrs' => 'required|integer|min:1',
            'nc_spend' => 'sometimes|numeric|min:0',
            'total_spend' => 'sometimes|numeric|min:0',
            'year' => 'required|integer|digits:4',
            'period' => 'required|string|max:255',
            'remarks' => 'sometimes|nullable|string|min:3',
        ];
    }
}
