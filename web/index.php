<?php
use Dotenv\Dotenv;
use FCT\Watten\App\AppKernel;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';

$dotEnv = new Dotenv(__DIR__ . '/..');
$dotEnv->load();

$kernel = new AppKernel('dev', true);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);