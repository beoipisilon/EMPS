<?php
require_once __DIR__ . '/../repositories/ProductRepository.php';

class ProductController {
    private $productRepository;

    public function __construct() {
        $this->productRepository = new ProductRepository();
    }

    public function handleRequest() {
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        try {
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 6;
            $sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'preco';
            $sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

            $page = max(1, $page);
            $perPage = max(1, min(50, $perPage));
            $sortOrder = in_array(strtolower($sortOrder), ['asc', 'desc']) ? strtolower($sortOrder) : 'asc';
            $sortBy = in_array($sortBy, ['preco', 'nome']) ? $sortBy : 'preco';

            $result = $this->productRepository->searchByName($searchTerm, $page, $perPage, $sortBy, $sortOrder);
            
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'error' => 'Erro interno do servidor',
                'message' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
    }
}  