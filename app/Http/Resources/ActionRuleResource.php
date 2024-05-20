<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ActionRuleResource extends JsonResource
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
            't_state_id' => $this->t_state_id,
            't_state_name'=>$this->name,
            'transaction_type_id' => $this->transaction_type_id,
            'transaction_type_name'=> $this->t_name,
            'blockly_xml' => $this->blockly_xml,
            'blockly_code' => $this->blockly_code,
            'preview' => $this->preview,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by
        ];
    }
}
