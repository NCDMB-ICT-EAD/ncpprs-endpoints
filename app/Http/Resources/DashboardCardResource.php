<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardCardResource extends JsonResource
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
            'is_disabled_formatted' => $this->is_disabled ? 'disabled' : 'active',
            'roles' => $this->roles->pluck('id')->toArray(),
        ];
    }
}
