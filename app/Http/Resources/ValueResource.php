<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'property_id' => $this->property_id,
            'language_id' => $this->language_id,
            'value' => $this->value,
            'state' => $this->state,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'id' => $this->id
        ];
    }
}
