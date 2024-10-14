<?php
header('Content-Type: application/json; charset=utf-8');

require_once "autoload.php";

use Controllers\Route;

$requestUrl = parse_url(htmlspecialchars($_SERVER["REQUEST_URI"]), PHP_URL_PATH);
$requestMethod = htmlspecialchars($_SERVER["REQUEST_METHOD"]);

$route = new Route;

$route->add("/", "GET", "Controllers\HomeController", "index");
$route->add("/search/{word}", "GET", "Controllers\SearchController", "index");

$route->match($requestUrl, $requestMethod);
