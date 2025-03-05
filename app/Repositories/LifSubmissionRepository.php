<?php
namespace App\Repositories;

use App\Models\LifSubmission;

class LifSubmissionRepository extends BaseRepository
{
    protected $relations = ['lifActivities'];

    public function __construct(LifSubmission $lifSubmission) {
        parent::__construct($lifSubmission);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
