<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslationChannelResource extends JsonResource
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
            'channelId' => $this->channel_id,
            'name' => $this->name,
            'profileImageUrl' => $this->profile_image_url,
            'profileImageWidth' => $this->profile_image_width,
            'profileImageHeight' => $this->profile_image_height,
            'channelCreatedAt' => $this->channel_created_at,
            'subscribersCount' => $this->subscribers_count === 0 ? null : $this->subscribers_count,
            'tier' => $this->tier ?? 'U',
            'goodEditor' => $this->good_editor,
            'mainFocusManual' => $this->main_focus_manual,
        ];
    }
}
