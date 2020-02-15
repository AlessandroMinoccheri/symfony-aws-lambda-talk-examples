<?php

declare(strict_types=1);


namespace App\UseCase;


use Psr\Log\LoggerInterface;

class RenamePhoto
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->error('here');
    }
}