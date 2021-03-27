<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            // TODO: make computed property focusName, build from own name + parent names, adjust vtubers.yaml
            'focusName' => $this->name,
            'parentId'  => $this->parent_id,
        ];
    }
}
