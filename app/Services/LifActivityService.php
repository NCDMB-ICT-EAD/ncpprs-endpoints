<?php

namespace App\Services;

use App\Repositories\LifActivityRepository;

class LifActivityService extends BaseService
{
    public function __construct(LifActivityRepository $lifActivityRepository)
    {
        parent::__construct($lifActivityRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'broker_id' => 'required|integer|exists:brokers,id',
            'amount' => 'required',
            'year' => 'required|integer',
            'period' => 'required|string|max:255',
            'time_frame' => 'required|string|max:255',
            'remarks' => 'sometimes|string|min:5',
            'lif_service_id' => 'required|integer|exists:lif_services,id',
            'lif_institution_id' => 'required|integer|exists:lif_institutions,id',
            'contractor_id' => 'required|integer|exists:companies,id',
        ];
    }
}
