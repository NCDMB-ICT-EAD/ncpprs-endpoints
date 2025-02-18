<?php

namespace App\Services;

use App\Repositories\LifActivityRepository;
use App\Repositories\LifSubmissionRepository;
use Illuminate\Support\Facades\DB;

class LifActivityService extends BaseService
{
    protected LifSubmissionRepository $lifSubmissionRepository;
    public function __construct(LifActivityRepository $lifActivityRepository, LifSubmissionRepository $lifSubmissionRepository)
    {
        parent::__construct($lifActivityRepository);
        $this->lifSubmissionRepository = $lifSubmissionRepository;
    }

    public function rules($action = "store"): array
    {
        return [
            'activities' => 'required|array',
            'activities.*.broker_id' => 'required|integer|exists:brokers,id',
            'activities.*.amount' => 'required',
            'year' => 'required|integer',
            'period' => 'required|string|max:255',
            'time_frame' => 'required|string|max:255',
            'lif_service_id' => 'required|integer|exists:lif_services,id',
            'activities.*.lif_institution_id' => 'required|integer|exists:lif_institutions,id',
            'activities.*.lif_service_category_id' => 'required|integer|exists:lif_service_categories,id',
            'activities.*.currency' => 'required|string|in:EUR,USD,NGN,GBP',
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $sortedData = array_diff_key($data, ['activities' => null]);

            $lifSubmission = $this->lifSubmissionRepository->create($sortedData);

            if (!$lifSubmission) {
                return null;
            }

            foreach ($data['activities'] as $activity) {
                $arrangedData = [
                    ...$activity,
                    'lif_submission_id' => $lifSubmission->id,
                ];

                parent::store($arrangedData);
            }

            return $lifSubmission;
        });
    }
}
