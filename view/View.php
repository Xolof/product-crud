<?php
    class View
    {
        private $sku;
        private $name;
        private $price;
        private $action;
        private $message;
        private $warning;
        private $errorMessage;
        private $searchResult;

        public function __construct(
            $sku,
            $name,
            $price,
            $action,
            $message,
            $warning,
            $errorMessage,
            $searchResult
        )
        {
            $this->sku = $sku;
            $this->name = $name;
            $this->price = $price;
            $this->action = $action;
            $this->message = $message;
            $this->warning = $warning;
            $this->errorMessage = $errorMessage;
            $this->searchResult = $searchResult;
        }

        public function render()
        {
            require("view/views/form.php");
        }
    }
