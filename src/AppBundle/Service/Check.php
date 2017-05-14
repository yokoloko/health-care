<?php
/**
 * Created by PhpStorm.
 * User: jthomassey
 * Date: 13/05/2017
 * Time: 20:07
 */

namespace AppBundle\Service;

use AppBundle\Service\Status\StatusInterface;

class Check
{
    /**
     * @var StatusInterface[]
     */
    private $checks;

    public function __construct(iterable $checks)
    {
        $this->checks = $checks;
    }

    /**
     * @return array
     */
    public function getStatus()
    {
        $statuses = [];
        foreach ($this->checks as $name => $check) {
            $statuses[$name] = $check->isRunning();
        }

        return ['APP' => !in_array(false, $statuses)] + $statuses;
    }

    /**
     * @return bool
     */
    public function isRunning():bool
    {
        foreach ($this->checks as $name => $check) {
            if (!$check->isRunning()) {
                return false;
            }
        }

        return true;
    }
}