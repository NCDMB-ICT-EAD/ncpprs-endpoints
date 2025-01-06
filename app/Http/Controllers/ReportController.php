<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Traits\ApiResponse;

class ReportController extends Controller
{
    use ApiResponse;
    public function __construct(protected ReportService $reportService){}

    public function handleRequest(callable $callback)
    {
        try {
            $data = $callback();
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage(), 500);
        }
    }

    public function projectDetails($projectId)
    {
        return $this->handleRequest(fn() => $this->reportService->projectDetails($projectId));
    }

    public function yearlyProjectPerformance(Request $request)
    {
        return $this->handleRequest(fn() => $this->reportService->yearlyProjectPerformance($request->input('year')));
    }

    public function contractorProjectStatus()
    {
        return $this->handleRequest(fn() => $this->reportService->contractorProjectStatus());
    }

    public function boardProjectSummary()
    {
        return $this->handleRequest(fn() => $this->reportService->boardProjectSummary());
    }

    public function departmentBoardProjectStatus()
    {
        return $this->handleRequest(fn() => $this->reportService->departmentBoardProjectStatus());
    }
}
