<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends BaseService
{
    public function __construct(PermissionRepository $permissionRepository)
    {
        parent::__construct($permissionRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            //
        ];
    }
}
