<?php
$formName = null;
$formSku = null;
$formPrice = null;

if ($searchResult) {
    $formName = $searchResult["name"] ?? null;
    $formSku = $searchResult["sku"] ?? null;
    $formPrice = $searchResult["price"] ?? null;
}

if ($postSku && $name && $price) {
    $formName = $name;
    $formSku = $postSku;
    $formPrice = $price;
};
