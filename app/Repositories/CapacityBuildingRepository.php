<?php

namespace App\Repositories;

use App\Models\CapacityBuilding;

class CapacityBuildingRepository extends BaseRepository
{
    public function __construct(CapacityBuilding $capacityBuilding) {
        parent::__construct($capacityBuilding);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
