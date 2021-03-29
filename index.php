<?php
require("model/Api.php");

$accessToken = trim(file_get_contents(__DIR__ . "/../config/token"));
$baseURL = trim(file_get_contents(__DIR__ . "/../config/baseurl"));

$api = new Api($accessToken, $baseURL);

// Allow only some input types
$postSku = filter_input(INPUT_POST, "sku", FILTER_SANITIZE_STRING);
$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// Allow only some values
$getAction = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
$postAction = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
$action = $postAction ?? $getAction ?? "form";

// Allow only some input types
$getSku = filter_input(INPUT_GET, "sku", FILTER_SANITIZE_STRING);
$sku = $postSku ?? $getSku;

$message = "";
$warning = "";
$errorMessage = "";
$searchResult = null;
$result = null;

require("controller/indexController.php");

require("view/form.php");
