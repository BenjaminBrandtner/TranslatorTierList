<?php


namespace App\Actions;


use App\Http\Clients\Youtube\YoutubeChannel;
use App\Http\Clients\Youtube\YoutubeClient;
use App\TranslationChannel;

class UpdateTranslationChannels
{
    public static function run(array $channelIds = null)
    {
        $ids = $channelIds ?? TranslationChannel::all('channel_id')->pluck('channel_id')->toArray();
        $channels = (new YoutubeClient())->getChannels($ids);
        $channels->each(fn($c) => self::updateTranslationChannel($c));
    }

    private static function updateTranslationChannel(YoutubeChannel $c)
    {
        TranslationChannel::whereChannelId($c->channelId)->update(
            [
                'name' => $c->name,
                'profile_image_url' => $c->logo->url,
                'profile_image_width' => $c->logo->width,
                'profile_image_height' => $c->logo->height,
                'channel_created_at' => $c->channel_created_at,
                'subscribers_count' => $c->subscribersCount,
            ]
        );
    }
}
