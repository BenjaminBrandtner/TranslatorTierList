<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChangeSuggestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'translationChannelId' => $this->translation_channel_id,
            'tier' => $this->tier,
            'goodEditor' => $this->good_editor,
        ];
    }
}
