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
            'shortName'  => $this->short_name,
            'emoji'      => $this->emoji,
            'categoryId' => $this->category_id,
        ];
    }
}
