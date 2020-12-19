<?php

namespace Tests\Unit;

use App\Http\Clients\Youtube\YoutubeChannel;
use App\Http\Clients\Youtube\YoutubeClient;
use Carbon\Carbon;
use Tests\TestCase;

class YoutubeClientTest extends TestCase
{
    /**
     * @test
     */
    public function itReturnsAYoutubeChannel()
    {
        $channels = (new YoutubeClient())->getChannels(['UC35ZxV8dz91YgXnhCU9s0Vw']);

        $this->assertInstanceOf(YoutubeChannel::class, $channels[0]);

        return $channels[0];
    }

    /**
     * @test
     */
    public function itReturnsAnEmptyCollectionForInvalidChannelIds()
    {
        $channels = (new YoutubeClient())->getChannels(['asdf']);

        $this->assertEmpty($channels);
    }

    /**
     * @test
     */
    public function itReturnsManyYoutubeChannels()
    {
        $channels = (new YoutubeClient())->getChannels(
            ['UC35ZxV8dz91YgXnhCU9s0Vw', 'UCdJdEguB1F1CiYe7OEi3SBg']
        ); //specifying the same id twice is silently ignored
        $this->assertInstanceOf(YoutubeChannel::class, $channels[0]);
        $this->assertInstanceOf(YoutubeChannel::class, $channels[1]);

        $this->assertNotSame($channels[0]->name, $channels[1]->name);
    }

    /**
     * @test
     * @depends itReturnsAYoutubeChannel
     * @param YoutubeChannel $channel
     */
    public function theReturnedChannelHasAllNecessaryInformation(YoutubeChannel $channel)
    {
        $this->assertEquals('UC35ZxV8dz91YgXnhCU9s0Vw', $channel->channelId);
        $this->assertEquals('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', $channel->url);
        $this->assertEquals('Hiandbye95', $channel->name);
        $this->assertInstanceOf(Carbon::class, $channel->channel_created_at);
        $this->assertIsInt($channel->subscribersCount);

        $this->assertIsString($channel->logo->url);
        $this->assertIsInt($channel->logo->width);
        $this->assertIsInt($channel->logo->height);
    }

    /**
     * @test
     */
    public function itCanFindChannelIdFromVideoId()
    {
        $id = (new YoutubeClient())->getChannelIdFromVideoId('CfY_6NQSK8g');

        $this->assertSame('UC35ZxV8dz91YgXnhCU9s0Vw', $id);
    }

    /**
     * @test
     */
    public function itReturnsNullForInvalidVideoIds()
    {
        $id = (new YoutubeClient())->getChannelIdFromVideoId('CfY_');

        $this->assertSame(null, $id);
    }

    /**
     * @test
     */
    public function itSplitsOver50ChannelIdsIntoMultipleApiCalls()
    {
        $mock = $this->createMockGuzzleClient(
            [
                __DIR__ . '/youtubeApiResponses/channel_1.json',
                __DIR__ . '/youtubeApiResponses/channel_1.json',
            ]
        );

        //don't format
        $ids = ['c1', 'c2', 'c3', 'c4', 'c5', 'c6', 'c7', 'c8', 'c9', 'c10', 'c11', 'c12', 'c13', 'c14', 'c15', 'c16', 'c17', 'c18', 'c19', 'c20', 'c21', 'c22', 'c23', 'c24', 'c25', 'c26', 'c27', 'c28', 'c29', 'c30', 'c31', 'c32', 'c33', 'c34', 'c35', 'c36', 'c37', 'c38', 'c39', 'c40', 'c41', 'c42', 'c43', 'c44', 'c45', 'c46', 'c47', 'c48', 'c49', 'c50', 'c51', 'c52'];

        (new YoutubeClient())->getChannels($ids);

        $this->assertEquals(0, $mock->count());

    }

}
