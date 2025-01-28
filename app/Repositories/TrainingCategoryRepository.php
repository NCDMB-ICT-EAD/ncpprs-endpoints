<?php

namespace App\Repositories;

use App\Models\TrainingCategory;

class TrainingCategoryRepository extends BaseRepository
{
    public function __construct(TrainingCategory $trainingCategory) {
        parent::__construct($trainingCategory);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
