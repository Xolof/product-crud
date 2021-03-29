<?php
    class Controller
    {
        private $api;
        private $sku;
        private $name;
        private $price;
        private $action;
        private $message;
        private $warning;
        private $errorMessage;
        private $searchResult;

        public function __construct($sku, $name, $price, $action, $api)
        {
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
            $this->action = $action;
            $this->api = $api;
            $this->message = "";
            $this->warning = "";
            $this->errorMessage = "";
            $this->searchResult = null;
        }

        public function init()
        {
            $this->determineAction();
        }

        private function determineAction()
        {
            try {
                switch ($this->action) {
                    case "search":
                        $this->searchAction();
                        break;

                    case "save":
                        $this->saveAction();
                        break;

                    case "delete":
                        $this->deleteAction();
                        break;
                }
            } catch (Exception $e) {
                $this->errorMessage = "Kunde inte hämta data.";
            }
        }

        private function searchAction()
        {
            if ($this->sku) {
                $this->searchResult = $this->api->getProductBySku($this->sku);
            } else {
                $this->errorMessage = "Ogiltig input.";
            }
        }

        private function saveAction()
        {
            if (strlen($this->sku) > 64) {
                $this->warning = "Sku får inte vara längre än 64 tecken";
                return;
            }
            if ($this->sku && $this->name && $this->price) {
                $product = $this->api->getProductBySku($this->sku);

                if (array_key_exists("name", $product)) {
                    if ($product["name"] != $this->name || $product["price"] != $this->price) {
                        $updateResult = $this->api->updateProduct($product, $this->sku, $this->name, $this->price);
                        if ($updateResult) {
                            $this->message = "Produkten har uppdaterats.";
                        }
                    } else {
                        $this->warning = "Inget nytt namn eller pris har angetts. Produkten har inte uppdaterats.";
                    }
                } else {
                    $addResult = $this->api->addProduct($this->sku, $this->name, $this->price);
                    if ($addResult) {
                        $this->message = "Produkten har lagts till.";
                    }
                }
            } else {
                $this->errorMessage = "Ogiltig input.";
            }
        }

        private function deleteAction()
        {
            if ($this->sku) {
                $deleteResult = $this->api->deleteProduct($this->sku);

                if ($deleteResult) {
                    if (json_decode($deleteResult) != "true") {
                        $this->warning = "Produkten finns ej och kan därför inte raderas.";
                    } else {
                        $this->message = "Produkten har raderats.";
                    }
                }
            } else {
                $this->errorMessage = "Ogiltig input.";
            }
        }

        public function getSku()
        {
            return $this->sku;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getPrice()
        {
            return $this->price;
        }

        public function getAction()
        {
            return $this->action;
        }

        public function getMessage()
        {
            return $this->message;
        }

        public function getWarning()
        {
            return $this->warning;
        }

        public function getErrorMessage()
        {
            return $this->errorMessage;
        }

        public function getSearchResult()
        {
            return $this->searchResult;
        }
    }
