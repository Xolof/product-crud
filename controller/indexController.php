<?php
try {
    switch($action) {
        case "search":
            if ($sku) {
                $searchResult = $api->getProductBySku($sku);
            } else {
                $errorMessage = "Ogiltig input.";
            }
            break;

        case "save":
            if (strlen($sku) > 64) {
                $warning = "Sku får inte vara längre än 64 tecken";
                break;
            }
            if ($sku && $name && $price) {
                $product = $api->getProductBySku($sku);

                if (array_key_exists("name", $product)) {
                    if ($product["name"] != $name || $product["price"] != $price) {
                        $updateResult = $api->updateProduct($product, $sku, $name, $price);
                        if ($updateResult) {
                            $message = "Produkten har uppdaterats.";
                        }
                    } else {
                        $warning = "Inget nytt namn eller pris har angetts. Produkten har inte uppdaterats.";
                    }
                } else {
                    $addResult = $api->addProduct($sku, $name, $price);
                    if ($addResult) {
                        $message = "Produkten har lagts till.";
                    }
                }
            } else {
                $errorMessage = "Ogiltig input.";
            }
            break;

        case "delete":
            if ($sku) {
                $deleteResult = $api->deleteProduct($sku);

                if ($deleteResult) {
                    if (json_decode($deleteResult) != "true") {
                        $warning = "Produkten finns ej och kan därför inte raderas.";
                    } else {
                        $message = "Produkten har raderats.";
                    }
                }
            } else {
                $errorMessage = "Ogiltig input.";
            }
            break;
    }
} catch (Exception $e) {
    $errorMessage = "Kunde inte hämta data.";
}
