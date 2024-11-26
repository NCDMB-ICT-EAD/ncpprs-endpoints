<?php

namespace App\Http\Resources;

use App\Pack\Helpers\CurrencyFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardProjectActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'amount_spent_formatted' => CurrencyFormatter::parse($this->amount_spent),
            'board_project_name' => $this->boardProject->title
        ];
    }
}
