<?php


namespace App\Http\Clients\Youtube;


use Carbon\Carbon;
use Google_Service_YouTube_Channel;

class YoutubeChannel
{
    public static string $baseUrl = 'https://www.youtube.com/channel/';

    public string $channelId;
    public string $url;
    public string $name;
    public ?Carbon $channel_created_at;
    public ?int $subscribersCount;
    public YoutubeChannelLogo $logo;

    public function __construct(Google_Service_YouTube_Channel $c)
    {
        $this->channelId = $c->getId();
        $this->url = static::$baseUrl . $this->channelId;
        $this->name = $c->getSnippet()->getTitle();
        $this->logo = new YoutubeChannelLogo($c->getSnippet()->getThumbnails()->getDefault());
        $this->channel_created_at = Carbon::make($c->getSnippet()->getPublishedAt());
        $this->subscribersCount = $c->getStatistics()->getSubscriberCount();
    }
}
