<?php

namespace App\Http\Resources;

use App\Pack\Helpers\CurrencyFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LifActivityResource extends JsonResource
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
            'institution_name' => $this->lifInstitution->name,
            'broker_name' => $this->broker->name,
            'amount_formatted' => CurrencyFormatter::parse($this->amount),
            'service_label' => $this->lifServiceCategories?->lifService?->label,
        ];
    }
}
