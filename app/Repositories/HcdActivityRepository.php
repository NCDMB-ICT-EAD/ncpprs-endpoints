<?php

namespace App\Repositories;

use App\Models\HcdActivity;
use Carbon\Carbon;

class HcdActivityRepository extends BaseRepository
{
    public function __construct(HcdActivity $hcdActivity) {
        parent::__construct($hcdActivity);
    }

    public function parse(array $data): array
    {
        return [
            ...$data,
            'year' => Carbon::parse($data['year'])->toTimeString(),
        ];
    }
}
