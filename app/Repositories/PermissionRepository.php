<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends BaseRepository
{
    public function __construct(Permission $permission) {
        parent::__construct($permission);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
