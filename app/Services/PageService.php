<?php

namespace App\Services;

use App\Repositories\PageRepository;

class PageService extends BaseService
{
    public function __construct(PageRepository $pageRepository)
    {
        parent::__construct($pageRepository);
    }

    public function rules($action = "store"): array
    {
        return [
            //
        ];
    }
}
