<?php

namespace App\Services;

use App\Repositories\BoardProjectActivityRepository;

class BoardProjectActivityService extends BaseService
{
    public function __construct(BoardProjectActivityRepository $boardProjectActivityRepository)
    {
        parent::__construct($boardProjectActivityRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            'board_project_id' => 'required|integer|exists:board_projects,id',
            'activity' => 'required|min:3',
            'year' => 'required|integer',
            'period' => 'required|string|max:255',
            'no_of_personnel' => 'required|integer',
            'man_hours' => 'required|integer',
            'amount_spent' => 'required',
            'remarks' => 'required|string',
            'status' => 'required|string|max:255',
        ];
    }
}
