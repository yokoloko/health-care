<?php
/**
 * Created by PhpStorm.
 * User: jthomassey
 * Date: 13/05/2017
 * Time: 19:02
 */

namespace AppBundle\Service\Status;

class Redis implements StatusInterface
{
    /**
     * @var \Predis\Client $client
     */
    private $client;

    public function __construct(\Predis\Client $client)
    {
        $this->client = $client;
    }

    public function isRunning():bool
    {
        try {
            $this->client->connect();
        } catch (\Predis\Connection\ConnectionException $e) {
            return false;
        }

        return true;
    }
}