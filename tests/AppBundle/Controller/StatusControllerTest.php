<?php

declare(strict_types=1);

namespace tests\AppBundle\Controller;

use AppBundle\Controller\StatusController;
use AppBundle\Service\Check;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;

class StatusControllerTest extends WebTestCase
{
    /**
     * @dataProvider statusDataProvider
     */
    public function testIndexAllStatuses($status, $running, $code, $expected)
    {
        $manager = $this->createMock(Check::class);

        $manager->method('getStatus')
            ->willReturn($status);

        $manager->method('isRunning')
            ->willReturn($running);

        $container = $this->createMock(Container::class);

        $container->expects($this->at(0))
            ->method('get')
            ->with('status.health')
            ->willReturn($manager);

        $controller = new StatusController();
        $controller->setContainer($container);

        $response = $controller->indexAction();
        $this->assertEquals($code, $response->getStatusCode());
        $this->assertEquals($expected, $response->getContent());
    }

    public function statusDataProvider()
    {
        return [
            [['APP' => true,  'MYSQL' => true, 'REDIS' => true], true, 200, '{"APP":true,"MYSQL":true,"REDIS":true}'],
            [['APP' => false, 'MYSQL' => true, 'REDIS' => false], false, 500, '{"APP":false,"MYSQL":true,"REDIS":false}'],
            [['APP' => false, 'MYSQL' => false, 'REDIS' => true], false, 500, '{"APP":false,"MYSQL":false,"REDIS":true}'],
            [['APP' => false, 'MYSQL' => false, 'REDIS' => false], false, 500, '{"APP":false,"MYSQL":false,"REDIS":false}']
        ];
    }
}