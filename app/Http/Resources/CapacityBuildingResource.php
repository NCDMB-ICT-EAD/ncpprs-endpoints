<?php

namespace App\Http\Resources;

use App\Pack\Helpers\CurrencyFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CapacityBuildingResource extends JsonResource
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
            'project_title' => $this->project->title,
            'schedule_name' => $this->schedule->name,
            'contractor_name' => $this->contractor->name,
            'nc_spend_formatted' => CurrencyFormatter::parse($this->nc_spend),
            'total_spend_formatted' => CurrencyFormatter::parse($this->total_spend)
        ];
    }
}
