<?php

namespace App\Repositories;

use App\Models\Training;

class TrainingRepository extends BaseRepository
{
    public function __construct(Training $training) {
        parent::__construct($training);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
