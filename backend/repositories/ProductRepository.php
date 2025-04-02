<?php

class ProductRepository {
    private $products = [];

    public function __construct() {
        $this->loadProducts();
    }

    private function loadProducts() {
        $jsonFile = __DIR__ . '/../data/products.json';
        if (file_exists($jsonFile)) {
            $jsonContent = file_get_contents($jsonFile);
            $this->products = json_decode($jsonContent, true);
        }
    }

    public function getAll() {
        return $this->products;
    }

    public function searchByName($searchTerm) {
        if (empty($searchTerm)) {
            return $this->products;
        }

        $searchTerm = strtolower($searchTerm);
        return array_filter($this->products, function($product) use ($searchTerm) {
            return strpos(strtolower($product['nome']), $searchTerm) !== false;
        });
    }

    public function toArray($products) {
        return array_map(function($product) {
            return $product->toArray();
        }, $products);
    }
} 