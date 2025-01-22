<?php

require __DIR__ . '/../vendor/autoload.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/users' && $method === 'GET') {
    // Code to get all users
    echo "Get all users";
} elseif (preg_match('/\/users\/(\d+)/', $uri, $matches) && $method === 'GET') {
    // Code to get a single user by id
    $id = $matches[1];
    echo "Get user with id: $id";
} elseif ($uri === '/users' && $method === 'POST') {
    // Code to create a new user
    echo "Create a new user";
} elseif (preg_match('/\/users\/(\d+)/', $uri, $matches) && $method === 'PUT') {
    // Code to update a user by id
    $id = $matches[1];
    echo "Update user with id: $id";
} elseif (preg_match('/\/users\/(\d+)/', $uri, $matches) && $method === 'DELETE') {
    // Code to delete a user by id
    $id = $matches[1];
    echo "Delete user with id: $id";
} else {
    // Invalid route
    http_response_code(404);
    echo "Route not found";
}