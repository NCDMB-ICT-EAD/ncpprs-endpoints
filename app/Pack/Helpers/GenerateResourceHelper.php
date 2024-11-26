<?php

namespace App\Pack\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

trait GenerateResourceHelper
{
    public function role($department): array
    {
        return [
            'name' => 'Enterprise Administrator',
            'slots' => 1,
            'department_id' => $department?->id,
        ];
    }

    public function department(): array
    {
        return [
            'name' => 'Administrators',
            'abv' => 'ADMD',
            'type' => 'directorate',
        ];
    }

    public function admin($role, $department): array
    {
        return [
            'identifier' => 'med.super.admin',
            'firstname' => 'Adiah',
            'surname' => 'Ekaro',
            'middlename' => 'Priye',
            'department_id' => $department?->id,
            'role_id' => $role?->id,
            'email' => 'med.admin@ncdmb.gov.ng',
            'password' => 'password',
            'type' => 'admin',
            'is_admin' => true
        ];
    }

    public function pages(array $roles): array
    {
        return [
            ['name' => 'Admin Centre', 'path' => '/admin-centre', 'type' => 'top-level', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 0],
            ['name' => 'Pages', 'path' => '/admin-centre/pages', 'type' => 'index', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 1],
            ['name' => 'Roles', 'path' => '/admin-centre/roles', 'type' => 'index', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 1],
            ['name' => 'Departments', 'path' => '/admin-centre/departments', 'type' => 'index', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 1],
            ['name' => 'Users', 'path' => '/admin-centre/users', 'type' => 'index', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 1],
            ['name' => 'Contractors', 'path' => '/admin-centre/contractors', 'type' => 'index', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 1],
            ['name' => 'Schedules', 'path' => '/admin-centre/schedules', 'type' => 'index', 'roles' => $roles, 'is_menu' => true, 'parent_id' => 1],
        ];
    }
}
