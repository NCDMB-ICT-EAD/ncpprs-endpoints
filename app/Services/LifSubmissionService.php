<?php
namespace App\Services;

use App\Pack\Helpers\Periods;
use Illuminate\Support\Facades\Log;
use App\Repositories\LifSubmissionRepository;

class LifSubmissionService extends BaseService
{
    public function __construct(protected LifSubmissionRepository $lifSubmissionRepository)
    {
        parent::__construct($lifSubmissionRepository);
    }

    public function rules($action = "store"): array
    {
        $id = "NULL";
        if ($action === "update") {
            $id = request()->route('lifSubmission');
        }
        $uniqueRule = "unique:lif_submissions,company_id,{$id},id," .
            "lif_service_id," . request()->lif_service_id . "," .
            "year," . request()->year . "," .
            "period," . request()->period;

        return [
            'company_id' => 'required|integer|exists:companies,id|' . $uniqueRule,
            'lif_service_id' => 'required|integer|exists:lif_services,id',
            'year' => 'required|integer|between:2010,' . now()->year,
            'period' => 'required|string|in:' . implode(',', Periods::HALVES),
            'time_frame' => 'required|string|in:' . implode(',', Periods::TIMEFRAMES),
            'lifActivities' => 'required|array',
            'lifActivities.*.lif_service_category_id' => 'required|exists:lif_service_categories,id',
            'lifActivities.*.lif_institution_id' => 'required|exists:lif_institutions,id',
            'lifActivities.*.broker_id' => 'required|exists:brokers,id',
            'lifActivities.*.amount' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.unique' => 'Another record already exists with same company ID, LIF service, year, and period combination.',
        ];
    }

}
