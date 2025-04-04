# Aplicação de Lista de Produtos EMPS6

Este projeto implementa uma aplicação de listagem de produtos usando Vue.js para o frontend e PHP com o framework EMPS6 para o backend.

## Estrutura do Projeto

```
.
├── frontend/           # Aplicação frontend Vue.js
├── backend/           # Backend PHP com EMPS6
│   ├── modules/       # Módulos da aplicação
│   │   └── api/      # Pontos finais da API
│   │       └── produtos.php # API de produtos
│   └── router.php    # Roteador da aplicação
└── emps/             # Framework EMPS6
    ├── htdocs/       # Raiz da web
    │   ├── .htaccess # Configurações de redirecionamento
    │   └── local/    # Configuração local
    └── vendor/       # Dependências
```

## Funcionalidades

- Listagem de produtos com funcionalidade de pesquisa
- Design responsivo com Tailwind CSS
- Suporte CORS para solicitações de origem cruzada
- Integração do framework EMPS6

## Configuração do EMPS6

O arquivo `local.php` contém todas as configurações necessárias para o funcionamento do EMPS6:

- **EMPS_SCRIPT_WEB**: Caminho web para a aplicação
- **EMPS_SCRIPT_PATH**: Caminho absoluto para a pasta htdocs
- **EMPS_DB_***: Configurações de conexão com o banco de dados
- **EMPS_ENV_NAME**: Ambiente de execução

## Instruções de Execução

### Usando o script de inicialização

1. Execute o arquivo `start.bat`:
   ```
   start.bat
   ```

   Isso irá iniciar:
   - Backend EMPS6 em http://localhost:8080
   - Frontend Vue.js em http://localhost:5173

### Manualmente

1. Para o Backend:
   ```
   cd backend
   php -S localhost:8080 router.php
   ```

2. Para o Frontend:
   ```
   cd frontend
   npm run dev
   ```

## Pontos Finais da API

### GET /api/produtos.php

Retorna uma lista de produtos.

**Parâmetros de Consulta:**
- `search` (opcional): Filtra os produtos pelo nome

**Exemplo de Resposta:**
```json
[
  {
    "id": 1,
    "nome": "Camiseta Branca",
    "descricao": "100% algodão, unissex",
    "preco": 59.90
  },
  ...
]
```

## Tecnologias Utilizadas

- Vue.js 3
- Tailwind CSS
- PHP 8.2
- Framework EMPS6