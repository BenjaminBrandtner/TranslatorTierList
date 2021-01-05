<?php

namespace Tests\Unit;

use App\TranslationChannel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslationChannelApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function youCanSearchOurDatabaseWithUrl()
    {
        TranslationChannel::factory()->createOne(['channel_id' => 'UC35ZxV8dz91YgXnhCU9s0Vw']);

        $this->postJson(
            '/api/translation-channels/search',
            ['url' => 'https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw']
        )
             ->assertStatus(200)
             ->assertJson(
                 [
                     'data' => [
                         'channelId' => 'UC35ZxV8dz91YgXnhCU9s0Vw',
                     ],
                 ]
             );

        $this->postJson(
            '/api/translation-channels/search',
            ['url' => 'https://www.youtube.com/channel/asdf']
        )
             ->assertStatus(404);
    }
}
