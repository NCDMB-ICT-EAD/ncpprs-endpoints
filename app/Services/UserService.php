<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
    }

    public function rules($action = "store"): array
    {
        $rules = [
            'identifier' => 'sometimes|nullable|max:15',
            'firstname' => 'required|string|max:100',
            'middlename' => 'sometimes|nullable|string|max:100',
            'surname' => 'required|string|max:100',
            'department_id' => 'required|integer|exists:departments,id',
            'role_id' => 'required|integer|exists:roles,id',
            'company_id' => 'required|integer|exists:companies,id',
            'email' => 'required|string|email|max:255',
            'avatar' => 'nullable|string|max:255',
            'type' => 'required|string|in:staff,third-party,support,admin',
            'is_admin' => 'sometimes|boolean',
            'blocked' => 'sometimes|boolean',
        ];

        if ($action === "store") {
            $rules['identifier'] .= '|unique:users,identifier';
            $rules['email'] .= '|unique:users,email';
        }

        return $rules;
    }
}
