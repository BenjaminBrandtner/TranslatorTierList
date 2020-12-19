<?php

namespace Tests\Unit;

use App\TranslationChannel;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TranslationChannelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function translationChannelHasChannelCreatedDate()
    {
        $date = Carbon::today();
        $translationChannel = TranslationChannel::create(['channel_created_at' => $date, 'channel_id' => 'a']);
        $translationChannel = $translationChannel->fresh();

        $this->assertTrue(($date->isSameAs($translationChannel->created)));
    }
}
