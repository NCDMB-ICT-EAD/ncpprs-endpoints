<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'name' => "{$this->firstname} {$this->surname}",
            'email' => $this->email,
            'role' => [
                'id' => $this->role->id,
                'name' => $this->role->name,
                'label' => $this->role->label,
                'pages' => $this->role->pages,
                'permissions' => $this->role->permissions
            ],
            'type' => $this->type,
            'is_admin' => $this->is_admin == 1,
            'blocked' => $this->blocked,
            'change_password' => $this->change_password,
            'avatar' => $this->avatar
        ];
    }
}
