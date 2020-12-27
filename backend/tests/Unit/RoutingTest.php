<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutingTest extends TestCase
{
    /**
     * @test
     */
    public function everyRouteReturnsTheSPA()
    {
        $this->get('/asdf')
             ->assertViewIs('index');
        $this->get('/asdf/asdf')
             ->assertViewIs('index');
    }

    /**
     * @test
     */
    public function nonexistantApiRoutesReturn404()
    {
        $this->getJson('/api/asdf')
             ->assertNotFound()
             ->assertJson([]);

        $this->getJson('/api/asdf/asdf')
             ->assertNotFound()
             ->assertJson([]);
    }
}
