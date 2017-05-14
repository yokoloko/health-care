<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class StatusController extends Controller
{
    /**
     * @Route("/status/", name="status")
     */
    public function indexAction()
    {
        $health = $this->container->get('status.health');
        return new JsonResponse(
            $health->getStatus(),
            $health->isRunning() ? 200:500
        );
    }
}
