<?php

namespace Tests\Unit;

use App\Actions\AddTranslationChannel;
use App\Exceptions\ChannelDoesntExistException;
use App\Exceptions\ChannelExistsException;
use App\Exceptions\InvalidTierException;
use App\Exceptions\InvalidUrlException;
use App\TranslationChannel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddingTranslationChannelsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function youCanAddChannels()
    {
        AddTranslationChannel::run('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', 's', true);

        $this->assertDatabaseCount('translation_channels', 1);
        $this->assertDatabaseHas(
            'translation_channels',
            [
                'name' => 'Hiandbye95',
                'tier' => 'S',
                'good_editor' => true,
            ]
        );
    }

    /**
     * @test
     */
    public function youCanAddChannelsByVideoUrl()
    {
        // TODO: does this really need to be a feature? if so, maybe in another command
        AddTranslationChannel::run('https://youtu.be/CfY_6NQSK8g', null, null);
        AddTranslationChannel::run('https://www.youtube.com/watch?v=CfY_6NQSK8g&feature=youtu.be', null, null, true);

        $this->assertDatabaseCount('translation_channels', 1);
    }

    /**
     * @test
     */
    public function youDontHaveToProvideTierOrEditorStatus()
    {
        AddTranslationChannel::run('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', null, null);

        $this->assertDatabaseCount('translation_channels', 1);
        $this->assertDatabaseHas(
            'translation_channels',
            [
                'name' => 'Hiandbye95',
                'tier' => null,
                'good_editor' => null,
            ]
        );
    }

    /**
     * @test
     */
    public function youHaveToProvideAValidUrl()
    {
        $mock = $this->createMockGuzzleClient([__DIR__ . '/youtubeApiResponses/video_none.json']);

        $this->expectException(InvalidUrlException::class);
        AddTranslationChannel::run('asdf', 's', true);
        $this->assertNull($mock->getLastRequest());


        $this->expectException(InvalidUrlException::class);
        AddTranslationChannel::run('https://youtu.be/CfY_', null, null);
        $this->assertNotNull($mock->getLastRequest());

        $this->assertDatabaseCount('translation_channels', 0);
    }

    /**
     * @test
     */
    public function youHaveToProvideAValidTier()
    {
        $this->expectException(InvalidTierException::class);
        AddTranslationChannel::run('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', 'g', true);

        $this->assertDatabaseCount('translation_channels', 0);
    }

    /**
     * @test
     */
    public function itChecksIfTheChannelAlreadyExistsInTheDatabase()
    {
        TranslationChannel::create(['channel_id' => 'UC35ZxV8dz91YgXnhCU9s0Vw']);
        $mock = $this->createMockGuzzleClient([__DIR__ . '/youtubeApiResponses/channel_1.json']);

        $this->expectException(ChannelExistsException::class);
        AddTranslationChannel::run('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', 'S', true);

        $this->assertNull($mock->getLastRequest());
        $this->assertDatabaseCount('translation_channels', 1);
    }

    /**
     * @test
     */
    public function youCanForceItToOverwriteTheChannelInTheDatabase()
    {
        TranslationChannel::create(['channel_id' => 'UC35ZxV8dz91YgXnhCU9s0Vw', 'name' => 'Hiandbye95', 'tier' => 'A']);

        AddTranslationChannel::run('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', 'S', true, true);

        $this->assertDatabaseCount('translation_channels', 1);
        $this->assertDatabaseHas(
            'translation_channels',
            [
                'name' => 'Hiandbye95',
                'tier' => 'S',
            ]
        );
    }

    /**
     * @test
     */
    public function itChecksIfTheChannelExistsOnYoutube()
    {
        $this->createMockGuzzleClient([__DIR__ . '/youtubeApiResponses/channel_none.json']);

        $this->expectException(ChannelDoesntExistException::class);
        AddTranslationChannel::run('https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw', 'S', true);

        $this->assertDatabaseCount('translation_channels', 0);
    }
}
