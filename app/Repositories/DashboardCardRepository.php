<?php

namespace App\Repositories;

use App\Models\DashboardCard;

class DashboardCardRepository extends BaseRepository
{
    public function __construct(DashboardCard $dashboardCard) {
        parent::__construct($dashboardCard);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
