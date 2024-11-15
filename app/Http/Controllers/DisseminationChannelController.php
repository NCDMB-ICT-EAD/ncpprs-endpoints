<?php

namespace App\Http\Controllers;

use App\Http\Resources\DisseminationChannelResource;
use App\Services\DisseminationChannelService;

class DisseminationChannelController extends BaseController
{
    public function __construct(DisseminationChannelService $disseminationChannelService) {
        parent::__construct($disseminationChannelService, 'DisseminationChannel', DisseminationChannelResource::class);
    }
}
