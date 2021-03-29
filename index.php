<?php
require("model/Api.php");
require("controller/Controller.php");
require("view/View.php");

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$postSku = filter_input(INPUT_POST, "sku", FILTER_SANITIZE_STRING);
$getSku = filter_input(INPUT_GET, "sku", FILTER_SANITIZE_STRING);
$sku = $postSku ?? $getSku;

$getAction = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
$postAction = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
$action = $postAction ?? $getAction ?? "default";

$accessToken = trim(file_get_contents(__DIR__ . "/../config/token"));
$baseURL = trim(file_get_contents(__DIR__ . "/../config/baseurl"));

$api = new Api($accessToken, $baseURL);

$controller = new Controller($sku, $name, $price, $action, $api);
$controller->init();

$view = new View(
    $controller->getSku(),
    $controller->getName(),
    $controller->getPrice(),
    $controller->getAction(),
    $controller->getMessage(),
    $controller->getWarning(),
    $controller->getErrorMessage(),
    $controller->getSearchResult()
);

$view->render();
