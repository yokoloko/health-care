<?php

declare(strict_types=1);

namespace tests\AppBundle\Service;

use AppBundle\Service\Status\StatusInterface;
use PHPUnit\Framework\TestCase;
use AppBundle\Service\Check;

class CheckTest extends TestCase
{
    /**
     * @dataProvider statusDataprovider()
     */
    public function testAllStatuses($services, $running, $return)
    {
        $mocks = [];
        foreach ($services as $name => $up) {
            $service = $this->createMock(StatusInterface::class);

            $service->method('isRunning')->willReturn($up);
            $mocks[$name] = $service;
        }

        $service = new Check($mocks);

        $this->assertEquals($running, $service->isRunning());
        $this->assertEquals($return, $service->getStatus());
    }

    public function statusDataprovider()
    {
        return [
            [['service1' => true, 'service2' => false], false, ['APP' => false, 'service1' => true, 'service2' => false]],
            [['service1' => true, 'service2' => true], true, ['APP' => true, 'service1' => true, 'service2' => true]],
            [['service1' => false, 'service2' => true], false, ['APP' => false, 'service1' => false, 'service2' => true]],
            [['service1' => false, 'service2' => false], false, ['APP' => false, 'service1' => false, 'service2' => false]]
        ];
    }
}