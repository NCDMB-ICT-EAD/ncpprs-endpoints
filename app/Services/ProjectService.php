<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService extends BaseService
{
    public function __construct(ProjectRepository $projectRepository)
    {
        parent::__construct($projectRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'contractor_id' => 'required|integer|exists:companies,id',
            'title' => 'required|string|max:255',
            'approval_date' => 'sometimes|nullable|date',
            'start_date' => 'required|date',
            'completion_date' => 'sometimes|nullable|date',
            'nc_amount' => 'sometimes|numeric',
            'total_amount' => 'required|numeric',
        ];
    }
}
