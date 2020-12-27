<?php


namespace App\Http\Clients\Youtube;


use Google_Client;
use Google_Service_YouTube;
use Illuminate\Support\Collection;
use Str;

class YoutubeClient
{
    private Google_Service_YouTube $youtubeService;

    public function __construct()
    {
        $client = new Google_Client();
        if (app()->has('testGuzzleClient')) {
            $client->setHttpClient(app('testGuzzleClient'));
        }
        $client->setDeveloperKey(config('services.youtube.key'));
        $this->youtubeService = new Google_Service_YouTube($client);
    }

    public function getChannels(array $ids): Collection
    {
        $chunks = collect($ids)->chunk(50);

        $channels = $chunks->flatMap(
            function ($ids)
            {
                $response = $this->youtubeService->channels->listChannels(
                    'snippet,statistics',
                    ['id' => $ids->toArray()]
                );
                return $response->getItems();
            }
        );

        return $channels->map(fn($c) => new YoutubeChannel($c));
    }

    public function getChannelIdFromVideoId(string $id): ?string
    {
        $response = $this->youtubeService->videos->listVideos('snippet', ['id' => $id]);

        if (empty($response->getItems())) {
            return null;
        }

        return $response->getItems()[0]->getSnippet()->channelId;
    }

    public static function getChannelIdFromUrl(string $url): string
    {
        return $channelId = (string)Str::of($url)->match('/youtube\.com\/channel\/([\w\d]+)/');
    }
}
