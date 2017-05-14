<?php
/**
 * Created by PhpStorm.
 * User: jthomassey
 * Date: 13/05/2017
 * Time: 20:02
 */

namespace AppBundle\Service\Status;

interface StatusInterface
{
    /**
     * Return service status
     *
     * @return bool
     */
    public function isRunning():bool;
}