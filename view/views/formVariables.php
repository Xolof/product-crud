<?php
$formName = null;
$formSku = null;
$formPrice = null;

if ($this->searchResult) {
    $formName = $this->searchResult["name"] ?? null;
    $formSku = $this->searchResult["sku"] ?? null;
    $formPrice = $this->searchResult["price"] ?? null;
}

if ($this->action != "search") {
    $formName = $this->name;
    $formSku = $this->sku;
    $formPrice = $this->price;
};
