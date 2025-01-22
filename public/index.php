<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

require __DIR__ . '/../vendor/autoload.php';

//$config = new Configuration(__DIR__ . '/../config/config.php');
$factory = new Factory('');

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//get request body
$body = file_get_contents('php://input');
// get args
$request = new Request($method, $uri, body: $body);
$response = new Response();

if (preg_match('/\/users\/(\d+)/', $uri, $matches) && $method === 'GET') {
    $id = $matches[1];
    $action = $factory->createGetAction($id);
    echo $action($request, $response)->getBody();
} elseif (preg_match('/\/users\/(\d+)/', $uri, $matches) && $method === 'POST') {
    $id = $matches[1];
    $action = $factory->createPostAction($id);
    echo $action($request, $response)->getBody(); {
    }
} elseif (preg_match('/\/users\/(\d+)/', $uri, $matches) && $method === 'GET') {
    // Code to get a single user by id
    $id = $matches[1];
    echo "Get user with id: $id";
} elseif ($uri === '/users' && $method === 'POST') {
    // Code to create a new user
    echo "Create a new user";
} elseif (preg_match('/\/users\/(\d+)\/medications\/(\d+)/', $uri, $matches) && $method === 'PATCH') {
    // Code to update a user by id
    $userId = $matches[1];
    $medicationId = $matches[2];
    $action = $factory->createPatchAction($userId, $medicationId);
    echo $action($request, $response)->getBody();
} elseif (preg_match('/\/users\/(\d+)\/medications\/(\d+)/', $uri, $matches) && $method === 'DELETE') {
    // Code to delete a user by id
    $userId = $matches[1];
    $medicationId = $matches[2];
    $action = $factory->createDeleteAction($userId, $medicationId);
    echo $action($request, $response)->getBody();
} else {
    // Invalid route
    http_response_code(404);
    echo "Route not found";
}