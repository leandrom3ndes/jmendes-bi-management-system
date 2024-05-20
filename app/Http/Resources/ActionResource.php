<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ActionResource extends JsonResource
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
            'action_rule_id' => $this->action_rule_id,
            'type' => $this->type,
            'name' => $this->name,
            'par_action_id' => $this->par_action_id,
            'prev_action_id' => $this->prev_action_id,
            'next_action_id' => $this->next_action_id,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by,
            'created_at'=> $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
