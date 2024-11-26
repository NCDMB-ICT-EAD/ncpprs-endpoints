<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EQApprovalResource extends JsonResource
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
            'date_applied_formatted' => Carbon::parse($this->date_applied)->format('M d, Y'),
            'date_approved_formatted' => Carbon::parse($this->date_approved)->format('M d, Y'),
        ];
    }
}
