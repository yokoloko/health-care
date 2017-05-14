<?php
declare(strict_types=1);

namespace tests\AppBundle\Service\Check;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\Status\Redis;

class RedisTest extends TestCase
{
    public function testIsRunningOk()
    {
        $client  = $this->createMock(\Predis\Client::class);
        $client->method('connect');

        $service = new Redis($client);
        $this->assertTrue($service->isRunning());
    }

    public function testIsNotRunning()
    {
        $exception = $this->createMock(\Predis\Connection\ConnectionException::class);

        $client  = $this->createMock(\Predis\Client::class);
        $client->method('connect')->willThrowException($exception);

        $service = new Redis($client);
        $this->assertFalse($service->isRunning());
    }
}