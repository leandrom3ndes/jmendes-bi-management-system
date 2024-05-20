<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class FormResource extends JsonResource
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
            'form_id' => $this->form_id,
            'action_id' => $this->action_id,
            'name'=>$this->name,
            'language_id' => $this->language_id,
            'json'=> $this->json,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by
        ];
    }
}
