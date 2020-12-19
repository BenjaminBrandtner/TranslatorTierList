<?php

namespace Tests\Unit\ThirdPartyApis;

use Carbon\Carbon;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_ChannelSnippet;
use Google_Service_YouTube_ChannelStatistics;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class YoutubeApiTest extends TestCase
{
    protected Google_Service_YouTube $service;

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function fetchChannelNameFromUrlUsingHttp()
    {
        $response = Http::get(
            'https://www.googleapis.com/youtube/v3/channels',
            [
                'id' => 'UC35ZxV8dz91YgXnhCU9s0Vw',
                'part' => 'snippet',
                'key' => config('services.youtube.key'),
            ]
        );

        $this->assertEquals(200, $response->status());
        $this->assertJson($response->body());

        $responseObj = $response->object();

        $this->assertEquals('Hiandbye95', $responseObj->items[0]->snippet->title);
    }

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function fetchChannelNameFromUrlUsingGoogleClient()
    {
        $response = $this->service->channels->listChannels('snippet', ['id' => 'UC35ZxV8dz91YgXnhCU9s0Vw']);

        $name = $response->getItems()[0]->getSnippet()->getTitle();

        $this->assertEquals('Hiandbye95', $name);
    }

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function fetchMultipleChannelNamesFromUrlsUsingGoogleClient()
    {
        $response = $this->service->channels->listChannels(
            'snippet,statistics',
            [
                'id' => [
                    'UC35ZxV8dz91YgXnhCU9s0Vw',
                    'UCdJdEguB1F1CiYe7OEi3SBg',
                ],
            ]
);

        $channels = $response->getItems();
        $name = $response->getItems()[0]->getSnippet()->getTitle();

        $this->assertCount(2, $channels);
        $this->assertEquals('Hiandbye95', $name);
    }

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function getAllNecessaryInfo()
    {
        $response = $this->service->channels->listChannels('snippet,statistics', ['id' => 'UC35ZxV8dz91YgXnhCU9s0Vw']);
        /**
         * @var Google_Service_YouTube_ChannelSnippet $snippet
         */
        $snippet = $response->getItems()[0]->getSnippet();
        /**
         * @var Google_Service_YouTube_ChannelStatistics $statistics
         */
        $statistics = $response->getItems()[0]->getStatistics();

        $logo = $snippet->getThumbnails()->getDefault();
        $this->assertObjectHasAttribute('url', $logo);
        $this->assertObjectHasAttribute('width', $logo);
        $this->assertObjectHasAttribute('height', $logo);

        $channelCreated = $snippet->getPublishedAt();
        Carbon::make($channelCreated);

        $subscriberCountIsHidden = $statistics->getHiddenSubscriberCount();
        $subscriberCount = $statistics->getSubscriberCount();

        $this->assertFalse($subscriberCountIsHidden);
        $this->assertIsInt((int)$subscriberCount); //subscriber count is 0 if hidden by the channel owner
    }

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function invalidIdsAreSilentlyIgnored()
    {
        $response = $this->service->channels->listChannels(
            'snippet,statistics',
            ['id' => 'abc,UC35ZxV8dz91YgXnhCU9s0Vw']
        );

        $this->assertTrue(sizeof($response->getItems()) == 1);
    }

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function getChannelIdFromName()
    {
        $response = $this->service->channels->listChannels('snippet,statistics', ['forUsername' => 'hiandbye95']);

        $this->assertSame('UC35ZxV8dz91YgXnhCU9s0Vw', $response->getItems()[0]->id);
    }

    /**
     * @test
     * @group ThirdPartyApi
     */
    public function getChannelIdFromVideo()
    {
        $response = $this->service->videos->listVideos('snippet', ['id' => 'CfY_6NQSK8g']);

        $this->assertSame('UC35ZxV8dz91YgXnhCU9s0Vw', $response->getItems()[0]->getSnippet()->channelId);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $client = new Google_Client();
        $client->setDeveloperKey(config('services.youtube.key'));
        $this->service = new Google_Service_YouTube($client);
    }
}
