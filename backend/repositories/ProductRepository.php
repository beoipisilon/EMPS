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

    public function searchByName($searchTerm, $page = 1, $perPage = 6, $sortBy = 'preco', $sortOrder = 'asc') {
        $filteredProducts = $this->products;
        
        if (!empty($searchTerm)) {
            $searchTerm = strtolower($searchTerm);
            $filteredProducts = array_filter($this->products, function($product) use ($searchTerm) {
                return strpos(strtolower($product['nome']), $searchTerm) !== false;
            });
        }

        // Sort products
        usort($filteredProducts, function($a, $b) use ($sortBy, $sortOrder) {
            $aValue = $a[$sortBy] ?? 0;
            $bValue = $b[$sortBy] ?? 0;
            
            if ($sortOrder === 'asc') {
                return $aValue <=> $bValue;
            }
            return $bValue <=> $aValue;
        });

        // Calculate pagination
        $total = count($filteredProducts);
        $totalPages = ceil($total / $perPage);
        $page = max(1, min($page, $totalPages));
        $offset = ($page - 1) * $perPage;
        
        $paginatedProducts = array_slice($filteredProducts, $offset, $perPage);

        return [
            'data' => $paginatedProducts,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
                'total_pages' => $totalPages
            ]
        ];
    }

    public function toArray($products) {
        return array_map(function($product) {
            return $product->toArray();
        }, $products);
    }
} 