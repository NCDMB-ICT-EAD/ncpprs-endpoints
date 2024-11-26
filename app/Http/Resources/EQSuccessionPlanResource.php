<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EQSuccessionPlanResource extends JsonResource
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
            'expatriate_name' => $this->expatriate_id > 0 ? $this->expatriate->name : "",
            'understudy_name' => $this->understudy_id > 0 ? $this->understudy->name : "",
            'due_date_formatted' => $this->due_date ? Carbon::parse($this->due_date)->format('Y-m-d') : "",
        ];
    }
}
