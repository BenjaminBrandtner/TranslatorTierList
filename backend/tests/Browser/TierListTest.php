<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TierListTest extends DuskTestCase
{
    /**
     * @test
     */
    public function theLogoLoads()
    {
        $this->browse(
            function (Browser $browser)
            {
                $browser->visit('/')
                        ->assertSee('Translator Tier List');
            }
        );
    }

    /**
     * @test
     */
    public function youCanSeeChannels()
    {
        $this->browse(
            function (Browser $browser)
            {
                $browser->visit('/')
                        ->waitForText('Aburage115')
                        ->waitForText('Khel Alter')
                        ->assertSee('Aburage115')
                        ->assertSee('Khel Alter');
            }
        );
    }

    /**
     * @test
     */
    public function youCanFilterChannels()
    {
        $this->browse(
            function (Browser $browser)
            {
                $browser->visit('/')
                        ->waitForText('Aburage115')
                        ->waitForText('Khel Alter')
                        ->assertSee('Aburage115')
                        ->assertSee('Khel Alter');

                $browser->type('@filter-name', 'Abu')
                        ->assertSee('Aburage115')
                        ->assertDontSee('Khel Alter');
            }
        );
    }
}
