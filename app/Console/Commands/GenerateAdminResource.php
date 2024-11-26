<?php

namespace App\Console\Commands;

use App\Pack\Helpers\GenerateResourceHelper;
use App\Services\DepartmentService;
use App\Services\PageService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Console\Command;

class GenerateAdminResource extends Command
{
    /**
     * Trait to handle all the
     * resource crud initializer
     * @trait
     */
    use GenerateResourceHelper;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected UserService $userService;
    protected RoleService $roleService;
    protected DepartmentService $departmentService;
    protected PageService $pageService;

    public function __construct(
        UserService $userService,
        RoleService $roleService,
        DepartmentService $departmentService,
        PageService $pageService
    ) {
        parent::__construct();
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->departmentService = $departmentService;
        $this->pageService = $pageService;
    }

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle(): void
    {
        $this->info('Creating Admin Department...');
        $department = $this->departmentService->store($this->department());
        $this->info('Creating Admin Role...');
        $role = $this->roleService->store($this->role($department));
        $this->info('Creating Admin User...');
        $this->userService->store($this->admin($role, $department));
        $this->info('Creating Pages...');

        $roles = [
            [
                "value" => $role->id,
                "label" => $role->name
            ]
        ];

        foreach($this->pages($roles) as $page) {
            $this->pageService->store($page);
        }

        $this->info('All Done...');
        $this->info('Build something amazing...');
    }
}
