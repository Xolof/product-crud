<?php
    class Api
    {
        private $token;
        private $baseURL;

        public function __construct($token, $baseURL)
        {
            $this->token = $token;
            $this->baseURL = $baseURL;
        }

        private function curlGET($url)
        {
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization:  Bearer $this->token"
            ));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($curl);

            curl_close($curl);

            if(curl_errno($curl)){
                throw new Exception(curl_error($curl));
            }

            return json_decode($json, true);
        }

        private function curlPOST($url, $body)
        {
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_POST, true);

            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "Authorization:  Bearer $this->token"
            ));

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $json = curl_exec($curl);

            if ($json === false) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }

            curl_close($curl);

            if(curl_errno($curl)){
                throw new Exception(curl_error($curl));
            }

            return json_decode($json, true);
        }

        private function curlPUT($url, $body)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'PUT',
              CURLOPT_POSTFIELDS => json_encode($body),
              CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $this->token",
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            if(curl_errno($curl)){
                throw new Exception(curl_error($curl));
            }

            return $response;
        }

        private function curlDELETE($url)
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'DELETE',
              CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $this->token"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            if(curl_errno($curl)){
                throw new Exception(curl_error($curl));
            }

            return $response;
        }

        public function getProductBySku($sku)
        {
            $url = "$this->baseURL/rest/V1/products/$sku";

            return $this->curlGET($url);
        }

        public function addProduct($sku, $name, $price)
        {
            $url = "$this->baseURL/rest/default/V1/products";

            $body = [
                "product" => [
                    "sku" => $sku,
                    "name" => $name,
                    "attribute_set_id" => 4,
                    "price" => $price,
                    "status" => 1,
                    "visibility" => 1,
                    "type_id" => "simple"
                ]
            ];

            return $this->curlPOST($url, $body);
        }

        public function updateProduct($product, $sku, $name, $price)
        {
            $url = "$this->baseURL/rest/all/V1/products/$sku";

            $product["name"] = $name;
            $product["price"] = $price;

            $body = [
                "product" => $product,
                "saveOptions" => true
            ];

            return $this->curlPUT($url, $body);
        }

        public function deleteProduct($sku)
        {
            $url = "$this->baseURL/rest/V1/products/$sku";
            return $this->curlDELETE($url);
        }
    }
