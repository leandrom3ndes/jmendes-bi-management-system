<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class LanguageResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug'=> $this->slug,
            'state'=> $this->state,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
