<?php

namespace App\Http\Resources;

use App\Pack\Helpers\CurrencyFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'contractor_name' => $this->contractor->name,
            'total_amount_formatted' => CurrencyFormatter::parse($this->total_amount),
            'nc_amount_formatted' => CurrencyFormatter::parse($this->nc_amount)
        ];
    }
}
