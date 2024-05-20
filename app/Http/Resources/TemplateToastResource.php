<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TemplateToastResource extends JsonResource
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
            'template_id' => $this->template_id,
            'language_id' => $this->language_id,
            'type' => $this->type,
            'name' => $this->name,
            'text' => $this->text,
            'class' => $this->class,
            'colour' => $this->colour,
            'title' => $this->title_text,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
