<?php

namespace App\Repositories;

use App\Models\Page;
use Illuminate\Support\Str;

class PageRepository extends BaseRepository
{
    public function __construct(Page $page) {
        parent::__construct($page);
    }

    public function parse(array $data): array
    {
        unset($data['roles']);

        return [
            ...$data,
            'label' => Str::slug($data['name']),
            'description' => $data['description'] ?? null,
            'icon' => $data['icon'] ?? null,
        ];
    }
}
