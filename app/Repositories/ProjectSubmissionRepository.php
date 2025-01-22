<?php

namespace App\Repositories;

use App\Models\ProjectSubmission;

class ProjectSubmissionRepository extends BaseRepository
{
    protected $relations = ['activities'];

    public function __construct(ProjectSubmission $projectSubmission) {
        parent::__construct($projectSubmission);
    }

    public function parse(array $data): array
    {
        return $data;
    }
}
