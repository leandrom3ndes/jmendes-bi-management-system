<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
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
            'id' => $this->id,
            'ent_type_id' => $this->ent_type_id,
            'state' => $this->state,
            'transaction_idi' => $this->transaction_id,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by
        ];
    }
}
