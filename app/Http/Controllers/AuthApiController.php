<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthUserResource;
use App\Services\UserService;

class AuthApiController extends BaseController
{
    public function __construct(UserService $userService)
    {
        parent::__construct($userService, 'Authenticated User', AuthUserResource::class);
    }
}
