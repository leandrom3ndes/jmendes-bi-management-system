<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class QueryResource extends JsonResource
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
            'query_id' => $this->query_id,
            'language_id' => $this->language_id,
            'name'=> $this->name,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by,
            'created_at'=> $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
