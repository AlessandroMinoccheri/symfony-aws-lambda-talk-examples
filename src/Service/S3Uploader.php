<?php


namespace App\Service;


use Aws\S3\S3Client;

class S3Uploader
{
    /**
     * @var S3Client
     */
    private $s3;
    /**
     * @var string
     */
    private $bucket;
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $region;
    /**
     * @var string
     */
    private $secret;

    public function __construct(
        S3Client $s3,
        string $bucket,
        string $key,
        string $region,
        string $secret
    ) {
        $this->s3 = $s3;
        $this->bucket = $bucket;
        $this->key = $key;
        $this->region = $region;
        $this->secret = $secret;
    }

    public function upload(string $path, string $contentType)
    {
        $s3Client = new S3Client([
            'version'     => 'latest',
            'region'      => $this->region,
            'credentials' => [
                'key'    => $this->key,
                'secret' => $this->secret
            ]
        ]);

        $s3Client->putObject([
            'Bucket'      => $this->bucket,
            'Key'         => 'uploads/test.jpg',
            'SourceFile'  => $path,
            'ContentType' => $contentType
        ]);
    }
}

