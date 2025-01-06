<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repositories\ReportRepository;

class ReportService
{
    public function __construct(protected ReportRepository $reportRepository){}

    /** PROJECT SUMMARY  */
    public function projectDetails($projectId)
    {
        try {
            $project = $this->reportRepository->getProjectById($projectId);

            $planned_overall_ncv = $project->scopes->sum('nc_value');
            $planned_overall_tcv = $project->scopes->sum('contract_value');

            $actual_overall_ncv = $project->scopes->flatMap->activities->sum('nc_value_spent');
            $actual_overall_tcv = $project->scopes->flatMap->activities->sum('total_value_spent');

            return $this->getProjectDetails(
                $project,
                $planned_overall_ncv,
                $planned_overall_tcv,
                $actual_overall_ncv,
                $actual_overall_tcv
            );
        } catch (ModelNotFoundException $e) {
            return $this->error(null, "Project with ID {$projectId} not found.", 500);
        }
    }

    private function getProjectDetails(
        $project,
        $planned_overall_ncv,
        $planned_overall_tcv,
        $actual_overall_ncv,
        $actual_overall_tcv
    ){
        return [
            'title' => $project->title,
            'description' => $project->description,
            'contractor' => $project->contractor->name,
            'approval_date' => $project->approval_date,
            'start_date' => $project->start_date,
            'completion_date' => $project->completion_date,
            'total_amount' => $project->total_amount,
            'nc_amount' => $project->nc_amount,
            'status' => $project->status,
            'timeline_performance' => $this->getTimelinePerformance($project->start_date, $project->completion_date),
            'schedules_summary' => $this->getSchedulesSummary($project->scopes, $planned_overall_tcv),
            'overall_nc_percentage' => [
                'planned' => $this->getPercentage($planned_overall_ncv, $planned_overall_tcv),
                'actual' => $this->getPercentage($actual_overall_ncv, $actual_overall_tcv),
            ]
        ];
    }

    private function getTimelinePerformance($startDate, $completionDate)
    {
        if ($startDate && $completionDate) {
            $today = Carbon::today();
            $startDate = Carbon::parse(Carbon::parse($startDate)->format('Y-m-d'));
            $completionDate = Carbon::parse(Carbon::parse($completionDate)->format('Y-m-d'));

            return $this->getPercentage($today->diffInDays($startDate), $completionDate->diffInDays($startDate));
        }

        return 0;
    }

    private function getSchedulesSummary($scopes, $planned_overall_tcv)
    {
        return $scopes->map(function ($scope) use ($planned_overall_tcv) {
            $activities = $scope->activities;

            $atcv = $activities->sum('total_value_spent');
            $atnv = $activities->sum('nc_value_spent');
            $n = $activities->sum('no_of_nigerians');
            $e = $activities->sum('no_of_expatriates');
            $nm = $activities->sum('ngn_man_hrs');
            $em = $activities->sum('expatriates_man_hrs');

            return [
                'schedule' => $scope->schedule->name,
                'relative_weight' => $this->getPercentage($scope->contract_value, $planned_overall_tcv),
                'planned' => [
                    'ptcv' => $scope->contract_value,
                    'ptnv' => $scope->nc_value,
                    'nc_percentage' => $this->getPercentage($scope->nc_value, $scope->contract_value),
                ],
                'actual' => [
                    'atcv' => $atcv,
                    'atnv' => $atnv,
                    'nc_percentage' => $this->getPercentage($atnv, $atcv),
                ],
                'personnels' => [
                    'nigerians' => $n,
                    'expatriates' => $e,
                    'nc_percentage' => $this->getPercentage($n, ($n + $e)),
                ],
                'man_hours' => [
                    'nigerian_man_hours' => $nm,
                    'expatriates_man_hours' => $em,
                    'nc_percentage' => $this->getPercentage($nm, ($nm + $em)),
                ],
            ];
        })->toArray();
    }

    /** YEARLY PROECT PERFORMANCE */
    public function yearlyProjectPerformance($year)
    {
        if ($year < 2010 || $year > now()->year) {
            return response()->json(['error' => 'Invalid year. Year must be between 2010 and ' . $currentYear], 400);
        }
        $projects = $this->reportRepository->getProjectsByYear($year);
        $overall_activities = $projects->flatMap->scopes->flatMap->activities;

        return
        [
            'projects' => $projects->map(function ($project) {
                $activities = $project->scopes->flatMap->activities;

                $atcv = $activities->sum('total_value_spent');
                $atnv = $activities->sum('nc_value_spent');
                $n = $activities->sum('no_of_nigerians');
                $e = $activities->sum('no_of_expatriates');
                $nm = $activities->sum('ngn_man_hrs');
                $em = $activities->sum('expatriates_man_hrs');

                return [
                    'project_name' => $project->title,
                    'main_contractor' => $project->contractor->name,
                    'start_date' => $project->start_date,
                    'expected_completion_date' => $project->completion_date,
                    'no_of_activities_reported' => $activities->count(),
                    'actual_nc_percentage' => $this->getPercentage($atnv, $atcv),
                    'actual_personnels_nc_percentage' => $this->getPercentage($n, $n + $e),
                    'actual_man_hour_nc_percentage' => $this->getPercentage($nm, $nm + $em),
                ];
            }),
            'overall' => [
                'no_of_activities_reported' => $overall_activities->count(),
                'actual_nc_percentage' => $this->getPercentage(
                    $overall_activities->sum('nc_value_spent'),
                    $overall_activities->sum('total_value_spent')
                ),
                'actual_personnels_nc_percentage' => $this->getPercentage(
                    $overall_activities->sum('no_of_nigerians'),
                    $overall_activities->sum('no_of_nigerians') + $overall_activities->sum('no_of_expatriates')
                ),
                'actual_man_hour_nc_percentage' => $this->getPercentage(
                    $overall_activities->sum('ngn_man_hrs'),
                    $overall_activities->sum('ngn_man_hrs') + $overall_activities->sum('expatriates_man_hrs')
                ),
            ]
        ];
    }

    /** CONTRACTOR PROJECT STATUS */
    public function contractorProjectStatus()
    {
        $contractors = $this->reportRepository->getContractorsWithProject();

        return $contractors->map(function ($contractor) {
            $statusCounts = $contractor->projects->groupBy('status')->map(function ($projects, $status) {
                return $projects->count();
            });

            return [
                'contractor_name' => $contractor->name,
                'pending' => $statusCounts->get('pending', 0),
                'in_progress' => $statusCounts->get('in-progress', 0),
                'in_review' => $statusCounts->get('in-review', 0),
                'awaiting_response' => $statusCounts->get('awaiting-response', 0),
                'verified' => $statusCounts->get('verified', 0),
                'completed' => $statusCounts->get('completed', 0),
                'overdue' => $statusCounts->get('overdue', 0),
            ];
        });
    }

    /** BOARD PROJECT SUMMARY */
    public function boardProjectSummary(){
        $boardProjects = $this->reportRepository->getBoardProjectsSummary();

        return $boardProjects->map(function ($project) {
            $totalApproved = $project->total_amount;
            $totalCommitted = $project->boardProjectActivities->sum('amount_spent');
            $totalRevenue = $project->boardProjectUtilizations->sum('revenue');

            return [
                'board_project' => $project->title,
                'contractor' => $project->contractor->name,
                'department' => $project->department->name,
                'total_approved' => $totalApproved,
                'total_committed' => $totalCommitted,
                'percentage_committed' => $this->getPercentage($totalCommitted, $totalApproved),
                'total_revenue' => $totalRevenue,
            ];
        });
    }

    /** DDD BOARD PROJECT STATUS */
    public function departmentBoardProjectStatus()
    {
        $departments = $this->reportRepository->getDeparmentsWithBoardProject();

        return $departments->map(function ($department) {
            // $statusCounts = $department->boardProjects->groupBy('status')->map(function ($boardProjects, $status) {
            //     return $boardProjects->count();
            // });

            return [
                'deparment_name' => $department->name,
                'count' => $department->boardProjects->count()
                // 'pending' => $statusCounts->get('pending', 0),
                // 'in_progress' => $statusCounts->get('in-progress', 0),
                // 'in_review' => $statusCounts->get('in-review', 0),
                // 'awaiting_response' => $statusCounts->get('awaiting-response', 0),
                // 'verified' => $statusCounts->get('verified', 0),
                // 'completed' => $statusCounts->get('completed', 0),
                // 'overdue' => $statusCounts->get('overdue', 0),
            ];
        });
    }

    private function getPercentage($num, $denum) {
        $percent = $denum != 0 ? round($num / $denum * 100, 2) : 0;
        return $percent . '%';
    }

}
