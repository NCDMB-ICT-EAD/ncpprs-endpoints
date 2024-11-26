<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends BaseService
{
    public function __construct(RoleRepository $roleRepository)
    {
        parent::__construct($roleRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'department_id' => 'required|integer|exists:departments,id',
            'name' => 'required|string|max:255',
            'max_slot' => 'required|integer',
            'is_blocked' => 'sometimes|integer|in:0,1',
            'is_super_admin' => 'sometimes|integer|in:0,1',
        ];
    }
}
