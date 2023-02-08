<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        //return parent::toArray($request);

        // return [
        //     'id' => $this->id,
        //     'attributes' => parent::toArray($request)
        // ];

        // Con Relacion Uno-A-Uno:
        return [
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                //'customer' => new CustomerResource($this->customer)
                'roles' => RoleResource::collection($this->roles)
            ]
        ];
    }
}
