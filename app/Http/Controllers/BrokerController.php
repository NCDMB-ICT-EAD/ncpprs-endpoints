<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrokerResource;
use App\Services\BrokerService;

class BrokerController extends BaseController
{
    public function __construct(BrokerService $brokerService) {
        parent::__construct($brokerService, 'Broker', BrokerResource::class);
    }
}
