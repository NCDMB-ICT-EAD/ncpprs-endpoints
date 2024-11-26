<?php

namespace App\Services;

use App\Repositories\DashboardCardRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\Facades\DB;

class DashboardCardService extends BaseService
{
    protected RoleRepository $roleRepository;
    public function __construct(
        DashboardCardRepository $dashboardCardRepository,
        RoleRepository $roleRepository
    ) {
        parent::__construct($dashboardCardRepository);
        $this->roleRepository = $roleRepository;
    }

    public function rules($action = "store"): array
    {
        return [
            'title' => 'required|string|max:255',
            'table_name' => 'required|string|max:255',
            'flag' => 'required|string|in:admin,department,user,contractor',
            'period' => 'required|string|in:all-time,current,custom',
            'filters' => 'nullable|string',
            'order_by' => 'required|string|in:sort,count',
            'data_sort' => 'required|string|in:asc,desc',
            'tagline' => 'nullable|string',
            'path' => 'nullable|string|max:255',
            'type' => 'required|string',
            'is_disabled' => 'nullable|boolean',
            'method_name' => 'required|string',
        ];
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $dashboardCard = parent::store($data);

            if ($dashboardCard) {
                foreach ($data['roles'] as $value) {
                    $role = $this->roleRepository->find($value);

                    if ($role && !in_array($role->id, $dashboardCard->roles()->pluck('id')->toArray())) {
                        $dashboardCard->roles()->save($role);
                    }
                }
            }

            return $dashboardCard;
        });
    }
}
