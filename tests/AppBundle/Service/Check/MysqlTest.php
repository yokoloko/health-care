<?php

declare(strict_types=1);

namespace tests\AppBundle\Service\Check;

use PHPUnit\Framework\TestCase;
use AppBundle\Service\Status\Mysql;
use Doctrine\DBAL\Exception\ConnectionException;
use Doctrine\DBAL\Connection;

class MysqlTest extends TestCase
{
    public function testIsRunningOk()
    {
        $client  = $this->createMock(Connection::class);
        $client->method('ping')->willReturn(true);

        $service = new Mysql($client);
        $this->assertTrue($service->isRunning());
    }

    public function testIsNotRunning()
    {
        $exception = $this->createMock(ConnectionException::class);

        $client  = $this->createMock(Connection::class);
        $client->method('ping')->willThrowException($exception);

        $service = new Mysql($client);
        $this->assertFalse($service->isRunning());
    }
}