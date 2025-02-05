<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Traits\ApiResponse;

class ReportController extends Controller
{
    use ApiResponse;
    public function __construct(protected ReportService $reportService){}

    public function handleRequest(callable $callback): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $callback();
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->error(null, $e->getMessage(), 500);
        }
    }

    public function projectDetails($projectId): \Illuminate\Http\JsonResponse
    {
        return $this->handleRequest(fn() => $this->reportService->projectDetails($projectId));
    }

    public function yearlyProjectPerformance(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->handleRequest(fn() => $this->reportService->yearlyProjectPerformance($request->input('year')));
    }

    public function contractorProjectStatus(): \Illuminate\Http\JsonResponse
    {
        return $this->handleRequest(fn() => $this->reportService->contractorProjectStatus());
    }

    public function boardProjectSummary(): \Illuminate\Http\JsonResponse
    {
        return $this->handleRequest(fn() => $this->reportService->boardProjectSummary());
    }

    public function departmentBoardProjectStatus(): \Illuminate\Http\JsonResponse
    {
        return $this->handleRequest(fn() => $this->reportService->departmentBoardProjectStatus());
    }
}
