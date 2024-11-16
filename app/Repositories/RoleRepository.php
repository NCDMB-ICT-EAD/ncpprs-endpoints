<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Support\Str;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $role) {
        parent::__construct($role);
    }

    public function parse(array $data): array
    {
        return [
            ...$data,
            'label' => Str::slug($data['name']),
        ];
    }
}
