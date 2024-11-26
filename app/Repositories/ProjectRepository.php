<?php

namespace App\Repositories;

use App\Models\Project;
use Carbon\Carbon;

class ProjectRepository extends BaseRepository
{
    public function __construct(Project $project) {
        parent::__construct($project);
    }

    public function parse(array $data): array
    {
        return [
            ...$data,
            'start_date' => Carbon::parse($data['start_date']),
            'completion_date' => isset($data['completion_date']) ? Carbon::parse($data['completion_date']) : null,
            'approval_date' => isset($data['approval_date']) ? Carbon::parse($data['approval_date']) : null,
        ];
    }
}
