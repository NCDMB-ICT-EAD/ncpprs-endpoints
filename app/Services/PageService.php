<?php

namespace App\Services;

use App\Repositories\PageRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;

class PageService extends BaseService
{
    protected PermissionRepository $permissionRepository;
    protected RoleRepository $roleRepository;
    private $bread = ["Browse", "Read", "Add", "Edit", "Delete"];
    public function __construct(
        PageRepository $pageRepository,
        PermissionRepository $permissionRepository,
        RoleRepository $roleRepository
    )
    {
        parent::__construct($pageRepository);
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function rules($action = "store"): array
    {
        $rules = [
            'parent_id' => 'required|integer|min:0',
            'name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'type' => 'required|string|max:255|in:top-level,index,view,form,external,dashboard,report,project',
            'description' => 'nullable|string|min:5',
            'roles' => 'required|array',
            'is_menu' => 'sometimes|integer|in:0,1',
            'is_disabled' => 'sometimes|integer|in:0,1',
        ];

        if ($action === "store") {
            $rules['path'] .= '|unique:pages';
        }

        return $rules;
    }

    private function getPermissions($moduleName): array
    {
        $permissions = [];

        foreach ($this->bread as $bread) {
            $permissions[] = "$bread $moduleName";
        }

        return $permissions;
    }

    private function storePermission($page, $permission): void
    {
        $this->permissionRepository->create([
            'page_id' => $page->id,
            'name' => $permission,
        ]);
    }

    /**
     * @throws \Exception
     */
    private function rolePageAccess($page, $record): void
    {
        $role = $this->roleRepository->find($record['value']);

        if ($role && !in_array($role->id, $page->roles->pluck('id')->toArray())) {
            $page->roles()->save($role);
        }
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $page = parent::store($data);

            if ($page) {
                foreach ($this->getPermissions($page->name) as $permission) {
                    $this->storePermission($page, $permission);
                }

                foreach ($data['roles'] as $record) {
                    $this->rolePageAccess($page, $record);
                }
            }

            return $page;
        });
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // Get previous record
            $record = $this->repository->find($id);
            // Save Previous record name
            $name = $record->label;
            // Update Record
            $page = parent::update($id, $data);

            if ($page) {
                // Check if the previously stored name is not equal to the updated name
                if ($page->label !== $name) {
                    $page->permissions()->delete();

                    foreach ($this->getPermissions($page->name) as $permission) {
                        $this->storePermission($page, $permission);
                    }
                }

                foreach ($data['roles'] as $record) {
                    $this->rolePageAccess($page, $record);
                }
            }

            return $page;
        });
    }

    public function destroy(int $id)
    {
        return  DB::transaction(function () use ($id) {
            $record = $this->repository->find($id);
            $record->permissions()->delete();
            $record->roles()->detach();
            parent::destroy($id);

            return true;
        });
    }
}
