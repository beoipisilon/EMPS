<?php
require_once __DIR__ . '/../repositories/ProductRepository.php';

class ProductController {
    private $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    public function handleRequest() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');

        try {
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $products = $this->productRepository->searchByName($searchTerm);
            
            echo json_encode(array_values($products));
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro interno do servidor']);
        }
    }
} 