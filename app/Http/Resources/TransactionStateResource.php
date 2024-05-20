<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TransactionStateResource extends JsonResource
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
            't_state_id' => $this->t_state_id,
            'language_id' => $this->language_id,
            'name' => $this->name,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'id' => $this->id
        ];
    }
}
