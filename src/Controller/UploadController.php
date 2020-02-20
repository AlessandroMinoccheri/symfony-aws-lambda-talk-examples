<?php


namespace App\Controller;


use App\Service\S3Uploader;
use App\UseCase\UploadPhoto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;

class UploadController extends AbstractController
{
    /**
     * @Rest\Get("/upload")
     */
    public function getHomeAction(Request $request)
    {
        return $this->render('upload.html.twig');
    }

    /**
     * @Rest\Post("/upload")
     */
    public function postHomeAction(Request $request, S3Uploader $s3Uploader)
    {
        try {
            $uploadPhoto = new UploadPhoto($s3Uploader);
            $file = $request->files->get('upload_file');

            $uploadPhoto->execute($file);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $this->render('upload.html.twig');
    }
}