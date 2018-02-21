<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Weekend\App;
require_once __DIR__ . '/../vendor/autoload.php';

// request wrapper
$request = Request::createFromGlobals();

$app = new App();
$response = $app->run($request);
$response->send();

