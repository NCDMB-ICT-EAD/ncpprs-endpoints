<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    use ApiResponse;

    protected ScheduleService $scheduleService;
    public function __construct(ScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * @throws \Exception
     */
    public function projectPerformance(): \Illuminate\Http\JsonResponse
    {
        $schedules = $this->scheduleService->index();

        $result = $schedules->map(function ($schedule) {
            $actuals = $this->scheduleService->computeActuals($schedule->id);
            $personnels = $this->scheduleService->computePersonnels($schedule->id);
            $manhrs = $this->scheduleService->computeManhrs($schedule->id);

            $tcv = $schedule->scopes->sum('contract_value');
            $ncv = $schedule->scopes->sum('nc_value');

            return [
                'id' => $schedule->id,
                'name' => $schedule->name,
                'planned' => [
                    'total_contract_value' => $tcv,
                    'total_nc_value' => $ncv,
                    'nc_percentage' => $tcv > 0 ? ($ncv / $tcv) * 100 : 0,
                ],
                'actual' => [
                    'total_contract_value' => $actuals['atcv'],
                    'total_nc_value' => $actuals['atncv'],
                    'nc_percentage' => $actuals['atcv'] > 0 ? ($actuals['atncv'] / $actuals['atcv']) * 100 : 0,
                ],
                'personnel' => [
                    'nigerians' => $personnels['nigerians'],
                    'expatriates' => $personnels['expatriates'],
                    'nc_percentage' => ($personnels['nigerians'] + $personnels['expatriates']) > 0
                        ? ($personnels['nigerians'] / ($personnels['nigerians'] + $personnels['expatriates'])) * 100
                        : 0,
                ],
                'man_hrs' => [
                    'nigerians' => $manhrs['ngn_man_hrs'],
                    'expatriates' => $manhrs['exp_man_hrs'],
                    'nc_percentage' => ($manhrs['ngn_man_hrs'] + $manhrs['exp_man_hrs']) > 0
                        ? ($manhrs['ngn_man_hrs'] / ($manhrs['ngn_man_hrs'] + $manhrs['exp_man_hrs'])) * 100
                        : 0,
                ],
            ];
        })->toArray();

        return $this->success($result);
    }
}
