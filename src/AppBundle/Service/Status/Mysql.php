<?php

namespace AppBundle\Service\Status;

use Doctrine\DBAL\Exception\ConnectionException;
use \Doctrine\DBAL\Connection;

class Mysql implements StatusInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        try {
            return $this->connection->ping();
        } catch (ConnectionException $e) {
            return false;
        }
    }
}