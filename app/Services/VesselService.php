<?php

namespace App\Services;

use App\Repositories\VesselRepository;

class VesselService extends BaseService
{
    public function __construct(VesselRepository $vesselRepository)
    {
        parent::__construct($vesselRepository);
    }

    public function rules($action = "store"): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'vessel_type' => 'required|string|max:255',
            'imo_no' => 'nullable|string|max:255',
            'nimasa_reg_no' => 'nullable|string|max:255',
            'flagging' => 'nullable|string|max:255',
        ];

        if ($action === "store") {
            $rules['imo_no'] .= '|unique:vessels,imo_no';
            $rules['nimasa_reg_no'] .= '|unique:vessels,nimasa_reg_no';
        }

        return $rules;
    }
}
