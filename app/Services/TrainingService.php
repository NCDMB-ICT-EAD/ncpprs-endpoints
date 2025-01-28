<?php

namespace App\Services;

use App\Pack\Helpers\Periods;
use Illuminate\Support\Facades\Log;
use App\Repositories\TrainingRepository;

class TrainingService extends BaseService
{
    public function __construct(protected TrainingRepository $trainingRepository)
    {
        parent::__construct($trainingRepository);
    }

    public function rules($action = "store"): array
    {
        $id = "NULL";
        if ($action === "update") {
            $id = request()->route('training');
        }
        $uniqueRule = "unique:trainings,company_id,{$id},id," .
            "training_category_id," . request()->training_category_id . "," .
            "year," . request()->year . "," .
            "period," . request()->period;

        return [
            'company_id' => 'required|integer|exists:companies,id|' . $uniqueRule,
            'training_category_id' => 'required|integer|exists:training_categories,id',
            'year' => 'required|integer|between:2010,' . now()->year,
            'period' => 'required|string|in:' . implode(',', Periods::QUARTERS),
            'no_of_trainees' => 'nullable|integer|min:0',
            'expenditure' => 'required|numeric',
            'remark' => 'nullable|string|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.unique' => 'Another record already exists with same company ID, training category, year, and period combination.',
        ];
    }

}
