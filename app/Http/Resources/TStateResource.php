<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class TStateResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            /*'process_type_id'=>$this->process_type_id,*/
            'id' => $this->id,
            't_state_id' => $this->id,
            //'state' => $this->state,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'language_id'=>$this->language_id,
            //'language_name'=>$this->language_name,
            'name'=>$this->name,
            'created_at'=>$this->created_at,
            'updated_by'=>$this->updated_by,
            'deleted_by'=>$this->deleted_by

        ];
    }

}
