<?php

namespace App\Repositories;

use App\Models\Hcd;

class HcdRepository extends BaseRepository
{
    public function __construct(Hcd $hcd) {
        parent::__construct($hcd);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
