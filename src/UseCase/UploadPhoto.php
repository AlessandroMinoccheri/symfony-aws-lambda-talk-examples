<?php

declare(strict_types=1);


namespace App\UseCase;


use App\Object\ContentType;
use App\Service\S3Uploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadPhoto
{
    /**
     * @var S3Uploader
     */
    private $uploader;

    public function __construct(S3Uploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function execute(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $dictionary = ContentType::buildFromExtension($extension);
        $contentType = $dictionary->getContentType();

        $this->uploader->upload($file->getRealPath(), $contentType);
    }
}