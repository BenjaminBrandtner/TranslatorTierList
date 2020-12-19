<?php

namespace Tests\Unit;

use App\TranslationChannel;
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
        //given there's one translation_channel in the db
        TranslationChannel::create(['channel_id' => 'asdf']);

        //if i create a change suggestion
        $this->post('/api/translation-channels/1/change-suggestions', ['tier' => 'S', 'goodEditor' => true])
             ->assertOk();

        //it should be in the database
        $this->assertDatabaseHas(
            'change_suggestions',
            [
                'translation_channel_id' => 1,
                'tier' => 'S',
                'good_editor' => true,
            ]
        );

        //and be listed in the index-response
        $this->getJson('/api/translation-channels/1/change-suggestions')
             ->assertOk()
             ->assertJsonCount(1, 'data')
             ->assertJsonFragment(['goodEditor' => true]);
    }

    /**
     * @test
     */
    public function cannotCreateChangeSuggestionForNonexistentChannel()
    {
        //given there's no translation_channels in the db
        $this->assertDatabaseCount('translation_channels', 0);

        //if i create a change suggestion it should return a 404
        $this->post('/api/translation-channels/1/change-suggestions', ['tier' => 'S'])->assertNotFound();
    }

    /**
     * @test
     */
    public function validationWorks()
    {
        //given there's one translation_channel in the db
        TranslationChannel::create(['channel_id' => 'asdf']);

        $this->postJson('/api/translation-channels/1/change-suggestions', ['tier' => 'lol'])
             ->assertStatus(422)
             ->assertJsonValidationErrors('tier');

        $this->postJson('/api/translation-channels/1/change-suggestions', ['goodEditor' => 'lol'])
             ->assertStatus(422)
             ->assertJsonValidationErrors('goodEditor');

        $this->postJson('/api/translation-channels/1/change-suggestions', [])
             ->assertStatus(422);
        // TODO: Main Focus
    }
}
