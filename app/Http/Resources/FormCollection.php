<?php

namespace App\Http\Resources;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FormCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => FormResource::collection($this->collection),
        ];
    }
}
