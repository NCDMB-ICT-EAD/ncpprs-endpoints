<?php

namespace App\Services;

use App\Repositories\ScheduleRepository;

class ScheduleService extends BaseService
{
    public function __construct(ScheduleRepository $scheduleRepository)
    {
        parent::__construct($scheduleRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'name' => 'required|string|max:255',
            'measurement_unit' => 'required|string|max:255',
            'nc_percentage' => 'sometimes|numeric',
            'is_blocked' => 'sometimes|in:0,1',
        ];
    }

    public function computeActuals(int $id) : array
    {
        $atcv = 0;
        $atncv = 0;

        $schedule = $this->show($id);

        if (!$schedule) {
            return [];
        }

        foreach ($schedule->scopes as $projectScope) {
            $atcv += $projectScope->activities->sum('total_value_spent');
            $atncv += $projectScope->activities->sum('nc_value_spent');
        }

        return [
            'atcv' => $atcv,
            'atncv' => $atncv,
        ];
    }

    public function computePersonnels(int $id) : array
    {
        $schedule = $this->show($id);

        if (!$schedule) {
            return [];
        }

        $nigerians = 0;
        $expatriates = 0;

        foreach ($schedule->scopes as $projectScope) {
            $expatriates += $projectScope->activities->sum('no_of_expatriates');
            $nigerians += $projectScope->activities->sum('no_of_nigerians');
        }

        return [
            'expatriates' => $expatriates,
            'nigerians' => $nigerians
        ];
    }

    public function computeManhrs(int $id) : array
    {
        $schedule = $this->show($id);

        if (!$schedule) {
            return [];
        }

        $ngn_man_hrs = 0;
        $exp_man_hrs = 0;

        foreach ($schedule->scopes as $projectScope) {
            $exp_man_hrs += $projectScope->activities->sum('expatriates_man_hrs');
            $ngn_man_hrs += $projectScope->activities->sum('ngn_man_hrs');
        }

        return [
            'exp_man_hrs' => $exp_man_hrs,
            'ngn_man_hrs' => $ngn_man_hrs
        ];
    }
}
