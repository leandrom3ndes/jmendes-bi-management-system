<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class QueryParameterResource extends JsonResource
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
            'query_id' => $this->id,
            'property_id' => $this->property_id,
            'property_name' => $this->property_name,
            'ent_type_id' => $this->ent_type_id,
            'ent_type_name' => $this->ent_type_name,
            'language_id' => $this->language_id
        ];
    }
}
