<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'deadline_at' => $this->deadline_at,
            'description' => $this->description,
            'priority' => new StatusResource($this->priority),
            'state' => new StatusResource($this->state),
            'created_by' => new UserResource($this->createdByUser),
            'assigned_users' => UserResource::collection($this->assignedUsers),
        ];
    }
}
