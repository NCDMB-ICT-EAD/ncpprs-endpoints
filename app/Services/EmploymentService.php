<?php

namespace App\Services;

use App\Pack\Helpers\Periods;
use Illuminate\Support\Facades\Log;
use App\Repositories\EmploymentRepository;

class EmploymentService extends BaseService
{
    public function __construct(protected EmploymentRepository $employmentRepository)
    {
        parent::__construct($employmentRepository);
    }

    public function rules($action = "store"): array
    {
        $id = "NULL";
        if ($action === "update") {
            $id = request()->route('employment');
        }
        $uniqueRule = "unique:employments,company_id,{$id},id," .
            "year," . request()->year . "," .
            "period," . request()->period;

        return [
            'company_id' => 'required|integer|exists:companies,id|' . $uniqueRule,
            'year' => 'required|integer|between:2010,' . now()->year,
            'period' => 'required|string|in:' . implode(',', Periods::QUARTERS),

            'new_foreign_permanent' => 'nullable|integer|min:0',
            'new_foreign_contract' => 'nullable|integer|min:0',
            'new_foreign_others' => 'nullable|integer|min:0',
            'new_nigerian_permanent' => 'nullable|integer|min:0',
            'new_nigerian_contract' => 'nullable|integer|min:0',
            'new_nigerian_others' => 'nullable|integer|min:0',

            'total_foreign_permanent' => 'nullable|integer|min:0',
            'total_foreign_contract' => 'nullable|integer|min:0',
            'total_foreign_others' => 'nullable|integer|min:0',
            'total_nigerian_permanent' => 'nullable|integer|min:0',
            'total_nigerian_contract' => 'nullable|integer|min:0',
            'total_nigerian_others' => 'nullable|integer|min:0',

            'remark' => 'nullable|string|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.unique' => 'Another record already exists with same company ID, year, and period combination.',
        ];
    }

}
