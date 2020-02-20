<?php

declare(strict_types=1);

use App\UseCase\RenamePhoto;
use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/config/bootstrap.php';
$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();

$request = Request::createFromGlobals();

//$logger = $kernel->getContainer()->get('logger');
//$logger->critical(var_dump($request, true));

return $kernel->getContainer()->get(RenamePhoto::class);
