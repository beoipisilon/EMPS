<?php

require_once __DIR__ . '/cors.php';

require_once __DIR__ . '/../local/local.php';

global $emps;

if (!isset($emps)) {
    die("Erro: Objeto EMPS não foi inicializado.");
}

header("Content-Type: application/json");

$produtos = [
    [
        "id" => 1,
        "nome" => "Camiseta Branca",
        "descricao" => "100% algodão, unissex",
        "preco" => 59.90
    ],
    [
        "id" => 2,
        "nome" => "Tênis Esportivo",
        "descricao" => "Confortável para corrida",
        "preco" => 199.90
    ],
    [
        "id" => 3,
        "nome" => "Relógio Digital",
        "descricao" => "Resistente à água",
        "preco" => 149.90
    ],
    [
        "id" => 4,
        "nome" => "Fone Bluetooth",
        "descricao" => "Alta qualidade de som",
        "preco" => 89.90
    ],
    [
        "id" => 5,
        "nome" => "Mochila Executiva",
        "descricao" => "Espaçosa e elegante",
        "preco" => 129.90
    ]
];

$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : "";

if ($search !== "") {
    $filtered_produtos = array_filter($produtos, function($produto) use ($search) {
        return strpos(strtolower($produto['nome']), $search) !== false ||
               strpos(strtolower($produto['descricao']), $search) !== false;
    });
    echo json_encode(array_values($filtered_produtos));
} else {
    echo json_encode($produtos);
}
exit;
