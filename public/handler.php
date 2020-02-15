<?php

declare(strict_types=1);

use App\UseCase\RenamePhoto;
use Symfony\Component\HttpKernel\Kernel;

require __DIR__ . '/../config/bootstrap.php';
$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

$renamePhoto = $kernel->getContainer()->get(RenamePhoto::class);
$renamePhoto->execute();