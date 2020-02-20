<?php

declare(strict_types=1);


namespace App\UseCase;


use App\Service\S3Copier;
use Bref\Context\Context;
use Bref\Event\S3\S3Event;
use Bref\Event\S3\S3Handler;
use Psr\Log\LoggerInterface;

class RenamePhoto extends S3Handler
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var S3Copier
     */
    private $s3Copier;

    public function __construct(LoggerInterface $logger, S3Copier $s3Copier)
    {
        $this->logger = $logger;
        $this->s3Copier = $s3Copier;
    }

    public function handleS3(S3Event $event, Context $context): void
    {
        $filename = $event->getRecords()[0]->getObject()->getKey();
        $this->logger->info('A new file was uploaded', [
            'filename' => $filename,
        ]);

        $this->s3Copier->copy($filename);
    }
}