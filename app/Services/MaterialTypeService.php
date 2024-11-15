<?php

namespace App\Services;

use App\Repositories\MaterialTypeRepository;

class MaterialTypeService extends BaseService
{
    public function __construct(MaterialTypeRepository $materialTypeRepository)
    {
        parent::__construct($materialTypeRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'name' => "required|string|max:255",
        ];
    }
}
