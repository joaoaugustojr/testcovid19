<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'cpf'               => $this->cpf,
            'age'               => $this->age,
            'whatsapp_number'   => $this->whatsapp_number,
            'photo_url'         => $this->photo_url,
            'created_at'        => $this->created_at,
        ];
    }
}
