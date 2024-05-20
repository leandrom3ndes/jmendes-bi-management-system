<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EntTypeResource extends JsonResource
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
            'ent_type_id' => $this->ent_type_id,
            'language_id' => $this->language_id,
            'name' => $this->name,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'transaction_type_id' => $this->transaction_type_id,
            'id' => $this->id
        ];
    }
}
