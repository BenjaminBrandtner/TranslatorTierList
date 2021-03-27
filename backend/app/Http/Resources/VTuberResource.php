<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VTuberResource extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'focusName'  => $this->focus_name,
            'categoryId' => $this->category_id,
        ];
    }
}
