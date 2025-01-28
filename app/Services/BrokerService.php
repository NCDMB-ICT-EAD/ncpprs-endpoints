<?php

namespace App\Services;

use App\Repositories\BrokerRepository;

class BrokerService extends BaseService
{
    public function __construct(BrokerRepository $brokerRepository)
    {
        parent::__construct($brokerRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'name' => "required|string",
            'address' => "required|string",
            'phone' => "required",
            'email' => "required|string|email|unique:brokers,email",
        ];
    }
}
