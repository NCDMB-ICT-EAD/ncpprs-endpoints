<?php

namespace App\Services;

use App\Repositories\LifInstitutionRepository;

class LifInstitutionService extends BaseService
{
    public function __construct(LifInstitutionRepository $lifInstitutionRepository)
    {
        parent::__construct($lifInstitutionRepository);
    }

    public function rules($action = "store"): array
    {
        $rules = [
            'name' => "required|string|max:255",
            'principal_officers' => "required|string|max:255",
            'address' => "required|string|min:3",
            'phone' => "required|max:255",
            'email' => "required|string|email|max:255",
            'classification' => "required|string|max:255",
            'category' => "required|string|max:255",
        ];

        if ($action == "store") {
            $rules['email'] .= "|unique:lif_institutions";
        }

        return $rules;
    }
}
