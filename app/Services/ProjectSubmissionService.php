<?php

namespace App\Services;

use App\Pack\Helpers\Periods;
use Illuminate\Support\Facades\Log;
use App\Repositories\ProjectSubmissionRepository;

class ProjectSubmissionService extends BaseService
{
    public function __construct(protected ProjectSubmissionRepository $projectSubmissionRepository)
    {
        parent::__construct($projectSubmissionRepository);
    }

    public function rules($action = "store"): array
    {
        $periods = Periods::QUARTERS;

        $id = "NULL";
        if ($action === "update") {
            $id = request()->route('projectSubmission');
        }
        $uniqueRule = "unique:project_submissions,project_id,{$id},id," .
            "year," . request()->year . "," .
            "period," . request()->period;

        return [
            'project_id' => 'required|integer|exists:projects,id|' . $uniqueRule,
            'year' => 'required|integer|between:2010,' . now()->year,
            'period' => 'required|string|in:' . implode(',', $periods),
            'activities' => 'required|array',
            'activities.*.project_scope_id' => 'required|exists:project_scopes,id',
            'activities.*.description' => 'nullable|string',
            'activities.*.total_value_spent' => 'required|numeric',
            'activities.*.nc_value_spent' => 'nullable|numeric',
            'activities.*.no_of_nigerians' => 'required|integer',
            'activities.*.no_of_expatriates' => 'required|integer',
            'activities.*.nigerians_man_hours' => 'required|numeric',
            'activities.*.expatriates_man_hours' => 'required|numeric',
        ];
    }

    public function messages($action = "store"): array
    {
        return [
            'project_id.unique' => 'Another record already exists with same project ID, year, and period combination.',
        ];
    }

}
