<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource {
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

        // Relacion 1:1 Inversa
        return [
            'id' => $this->id,
            'attributes' => [
                'user_id' => $this->user_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'city' => $this->city,
                'country' => $this->country,
                'telefono' => $this->telefono,
                'fecha_nacimiento' => $this->fecha_nacimiento,
                'dni' => $this->dni,
                'user' => new UserResource($this->user),
                'blablacars' => BlablacarResource::collection($this->blablacars),
                'vehiculos' => VehiculoResource::collection($this->vehiculos),
            ]
        ];
    }
}
