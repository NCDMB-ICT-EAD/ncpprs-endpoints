<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResearchLibraryResource;
use App\Services\ResearchLibraryService;

class ResearchLibraryController extends BaseController
{
    public function __construct(ResearchLibraryService $researchLibraryService) {
        parent::__construct($researchLibraryService, 'ResearchLibrary', ResearchLibraryResource::class);
    }
}
