<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService extends BaseService
{
    public function __construct(CompanyRepository $companyRepository)
    {
        parent::__construct($companyRepository);
    }

    public function rules($action = "store"): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|max:255',
            'ncec_no' => 'required|string|max:255',
            'nogicjqs_cert_no' => 'required|string|max:255',
            'nimasa_reg_no' => 'required|string|max:255',
            'representative' => 'required|string|max:255',
        ];

        if ($action == "store") {
            $rules['email'] .=  '|unique:companies,email';
            $rules['phone'] .=  '|unique:companies,phone';
            $rules['ncec_no'] .=  '|unique:companies,ncec_no';
            $rules['nogicjqs_cert_no'] .=  '|unique:companies,nogicjqs_cert_no';
            $rules['nimasa_reg_no'] .=  '|unique:companies,nimasa_reg_no';
        }

        return $rules;
    }
}
