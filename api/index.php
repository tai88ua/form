<?php

use App\Repository\UserRepository;
use App\Service\Logger;
use App\Service\Registration;

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/config.php';


$logger = new Logger(LOG_PATH);
$repository = new UserRepository(DB_PATH);
$registration = new Registration($repository, $logger);

$controller = new \App\Controller\Main(new App\View\View());
$controller->index($registration);
