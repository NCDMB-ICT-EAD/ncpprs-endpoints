<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $user) {
        parent::__construct($user);
    }

    public function parse(array $data): array
    {
        $password = strtolower($data['firstname']) . strtolower($data['surname']);

        return [
            ...$data,
            'password' => isset($data['password']) ? Hash::make($data['password']) : Hash::make($password),
        ];
    }
}
