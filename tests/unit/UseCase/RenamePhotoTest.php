<?php

declare(strict_types=1);


use App\UseCase\RenamePhoto;
use PHPUnit\Framework\TestCase;
use Symfony\Bridge\Monolog\Logger;

class RenamePhotoTest extends TestCase
{
    public function test_it_should_rename_photo()
    {
        $logger = $this->prophesize(Logger::class);
        $renamePhoto = new RenamePhoto($logger->reveal());

        $logger->error('here')->shouldBeCalled();
        $renamePhoto->execute();
    }
}