<?php

namespace Tests\Unit;

use App\ChangeSuggestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Testcase;

class ChangeSuggestionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function anyUserCanCreateAChangeSuggestion()
    {
        $this->withoutExceptionHandling();
        $this->postJson(
            'api/change-suggestions',
            [
                'url' => 'https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw/videos',
                'tier' => 'U',
            ]
        )
             ->assertStatus(201);

        $this->assertDatabaseHas(
            'change_suggestions',
            [
                'channel_id' => 'UC35ZxV8dz91YgXnhCU9s0Vw',
                'tier' => 'U',
                'good_editor' => null,
            ]
        );
    }

    /**
     * @test
     */
    public function theYoutubeApiIsntCalled()
    {
        $mock = $this->createMockGuzzleClient([]);
        $this->postJson(
            'api/change-suggestions',
            [
                'url' => 'https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw',
                'tier' => 'U',
            ]
        );

        $this->assertNull($mock->getLastRequest());
    }

    /**
     * @test
     */
    public function validationWorks()
    {
        //url is required
        $this->postJson('/api/change-suggestions', [])
             ->assertStatus(422)
             ->assertJsonValidationErrors('url');

        //only valid youtube channel urls
        $this->postJson(
            'api/change-suggestions',
            [
                'url' => 'https://www.youtube.com/c/asdf',
                'tier' => 'U',
            ]
        )
             ->assertStatus(422)
             ->assertJsonValidationErrors('url');

        //tier needs to exist, goodEditor must be boolean
        $this->postJson(
            'api/change-suggestions',
            [
                'url' => 'https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw',
                'tier' => 'asdf',
                'goodEditor' => 'asdf',
            ]
        )
             ->assertStatus(422)
             ->assertJsonValidationErrors(['tier', 'goodEditor']);

        $this->assertDatabaseCount('change_suggestions', 0);
    }

    /**
     * @test
     */
    public function youCanSearchTheDatabaseWithUrl()
    {
        ChangeSuggestion::factory()->createOne(['channel_id' => 'UC35ZxV8dz91YgXnhCU9s0Vw']);

        $this->postJson(
            '/api/change-suggestions/search',
            ['url' => 'https://www.youtube.com/channel/UC35ZxV8dz91YgXnhCU9s0Vw']
        )
             ->assertStatus(200)
             ->assertJsonCount(1, 'data');

        $this->postJson(
            '/api/change-suggestions/search',
            ['url' => 'https://www.youtube.com/channel/asdf']
        )
             ->assertStatus(404);
    }
}
