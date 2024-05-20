<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PropertyResource extends JsonResource
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
            'name' => $this->name,
            'value_type' => $this->value_type,
            'fk_property_id' => $this->fk_property_id,
            'requires_translation' => $this->requires_translation,
            'form_field_name' => $this->form_field_name,
            'ent_type_id' => $this->ent_type_id,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'id' => $this->id
        ];
    }
}
