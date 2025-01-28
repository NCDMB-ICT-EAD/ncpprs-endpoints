<?php

namespace App\Repositories;

use App\Models\Employment;

class EmploymentRepository extends BaseRepository
{
    public function __construct(Employment $employment) {
        parent::__construct($employment);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
