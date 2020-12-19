<?php

namespace Tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createMockGuzzleClient(array $responseFilepaths)
    {
        $mock = new MockHandler(
            collect($responseFilepaths)->map(
                fn($path) => new Response(
                    200, [], file_get_contents($path)
                )
            )->toArray()
        );
        $handlerStack = HandlerStack::create($mock);
        $client = new GuzzleClient(['handler' => $handlerStack, 'verify' => false]);
        $this->instance('testGuzzleClient', $client);

        return $mock;
    }
}
