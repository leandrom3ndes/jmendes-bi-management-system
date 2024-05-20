<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'role_id' => $this->role_id,
            'language_id' => $this->language_id,
            'name'=> $this->name,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by,
            'created_at'=> $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'id' => $this->id
        ];
    }

}
