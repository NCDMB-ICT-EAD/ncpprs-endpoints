<?php

namespace App\Http\Resources;

use App\Pack\Helpers\CurrencyFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
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
            'project_scope' => $this->projectScope->scope,
            'total_value_spent_formatted' => CurrencyFormatter::parse($this->total_value_spent),
            'nc_value_spent_formatted' => CurrencyFormatter::parse($this->nc_value_spent)
        ];
    }
}
