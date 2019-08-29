<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class UploadController extends AbstractController
{
    /**
     * @Rest\Get("/upload")
     */
    public function getHomeAction(Request $request)
    {
        echo getenv('AWS_ENV_VARIABLES');

        return $this->render('upload.html.twig');
    }

    /**
     * @Rest\Post("/upload")
     */
    public function postHomeAction(Request $request)
    {
        return $this->render('upload.html.twig');
    }
}