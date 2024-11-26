<?php

namespace App\Repositories;

use App\Models\CapacityBuildingActivity;
use Carbon\Carbon;

class CapacityBuildingActivityRepository extends BaseRepository
{
    public function __construct(CapacityBuildingActivity $capacityBuildingActivity) {
        parent::__construct($capacityBuildingActivity);
    }

    public function parse(array $data): array
    {
        return [
            ...$data,
            'year' => Carbon::parse($data['year'])->toTimeString(),
        ];
    }
}
