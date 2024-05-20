<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TransactionTypeResource extends JsonResource
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
            'transaction_type_id' => $this->transaction_type_id,
            'language_id' => $this->language_id,
            't_name'=> $this->t_name,
            'rt_name'=> $this->rt_name,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by,
            'created_at'=> $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'id' => $this->id
        ];
    }
}
