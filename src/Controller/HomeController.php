<?php

declare(strict_types=1);


namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class HomeController extends AbstractController
{
    /**
     * @Rest\Get("/")
     */
    public function getHomeAction(Request $request, LoggerInterface $logger)
    {
        $logger->critical('This is a critical!');

        return new JsonResponse(
            [
                'Italy' => [
                    'Rome',
                    'Milan',
                    'Verona'
                ],
                'MY_CUSTOM_ENV_VARIABLES' => $_ENV['MY_CUSTOM_ENV_VARIABLES'],
                'AWS_ENV_VARIABLES' => $_ENV['AWS_ENV_VARIABLES']
            ],
            200, array('application/json')
        );
    }
}