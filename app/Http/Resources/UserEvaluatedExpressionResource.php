<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserEvaluatedExpressionResource extends JsonResource
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
            'user_evaluated_expression_id' => $this->user_evaluated_expression_id,
            'language_id' => $this->language_id,
            'expression_name'=> $this->expression_name,
            'expression_text'=> $this->expression_text,
            'updated_by'=> $this->updated_by,
            'deleted_by'=> $this->deleted_by,
            'created_at'=> $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
