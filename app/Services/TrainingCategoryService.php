<?php

namespace App\Services;

use App\Pack\Helpers\Periods;
use Illuminate\Support\Facades\Log;
use App\Repositories\TrainingCategoryRepository;

class TrainingCategoryService extends BaseService
{
    public function __construct(protected TrainingCategoryRepository $trainingCategoryRepository)
    {
        parent::__construct($trainingCategoryRepository);
    }

    public function rules($action = "store"): array
    {
        $id = "NULL";
        if ($action === "update") {
            $id = request()->route('trainingCategory');
        }
        $uniqueRule = "unique:training_categories,name,{$id},id";

        return [
            'name' => 'required|string|max:255|' . $uniqueRule,
            'description' => 'required|string|max:255',
        ];
    }

}
