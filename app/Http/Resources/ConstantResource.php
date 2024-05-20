<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ConstantResource extends JsonResource
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
            'constant_id' => $this->constant_id,
            'language_id' => $this->language_id,
            'value' => $this->value,
            'name'=> $this->name,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by
        ];
    }
}
