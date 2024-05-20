<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PropertyValueResource extends JsonResource
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
            'p_a_v_id' => $this->p_a_v_id,
            'property_id' => $this->property_id,
            'language_id' => $this->language_id,
            'name' => $this->name,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'id' => $this->id
        ];
    }
}
