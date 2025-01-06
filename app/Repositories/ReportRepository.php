<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Project;
use App\Models\Department;
use App\Models\BoardProject;

class ReportRepository
{
    public function __construct(
        protected Project $project,
        protected Company $contractor,
        protected BoardProject $boardProject,
        protected Department $department,
    ) {}

    public function getProjectById($projectId)
    {
        return $this->project->with(['contractor', 'scopes.schedule', 'scopes.activities'])->findOrFail($projectId);
    }

    public function getProjectsByYear($year)
    {
        return $this->project->with(['contractor', 'scopes.activities' => function ($query) use ($year) {
            $query->where('year', $year);
        }])
        ->whereHas('scopes.activities', function ($query) use ($year) {
            $query->where('year', $year);
        })
        ->get();
    }

    public function getContractorsWithProject()
    {
        return $this->contractor->has('projects')->with('projects')->get();
    }

    public function getBoardProjectsSummary()
    {
        return $this->boardProject->with(['contractor', 'department', 'boardProjectActivities', 'boardProjectUtilizations'])->get();
    }

    public function getDeparmentsWithBoardProject()
    {
        return $this->department->has('boardProjects')->with('boardProjects')->get();
    }
}
