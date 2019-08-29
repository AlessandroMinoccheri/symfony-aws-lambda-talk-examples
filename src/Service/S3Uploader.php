<?php


namespace App\Service;


use Aws\S3\S3Client;

class S3Uploader
{

    public function upload(
        S3Client $s3,
        string $bucket,
        string $contentType,
        string $key,
        string $path
    ) {
        $s3->putObject([
            'Bucket'      => $bucket,
            'Key'         => $key,
            'SourceFile'  => $path,
            'ContentType' => $contentType
        ]);
    }



}

