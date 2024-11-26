<?php

namespace App\Repositories;

use App\Models\Schedule;
use Illuminate\Support\Str;

class ScheduleRepository extends BaseRepository
{
    public function __construct(Schedule $schedule) {
        parent::__construct($schedule);
    }

    public function parse(array $data): array
    {
        return [
            ...$data,
            'slug' => Str::slug($data['name']),
        ];
    }
}
