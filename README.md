# Aplicação de Lista de Produtos EMPS6

Este projeto implementa uma aplicação de listagem de produtos usando Vue.js para o frontend e PHP com o framework EMPS6 para o backend.

## Estrutura do Projeto

```
.
├── frontend/           # Aplicação frontend Vue.js
│   ├── src/           # Código fonte Vue.js
│   │   ├── components/ # Componentes Vue
│   │   │   ├── ProductCard.vue  # Card de produto
│   │   │   ├── Pagination.vue   # Componente de paginação
│   │   │   └── SortControls.vue # Controles de ordenação
│   │   └── App.vue    # Componente principal
├── backend/           # Backend PHP com EMPS6
│   ├── api/           # Pontos finais da API
│   │   └── produtos.php # API de produtos
│   ├── controllers/   # Controladores
│   │   └── ProductController.php # Controlador de produtos
│   ├── repositories/  # Repositórios
│   │   └── ProductRepository.php # Repositório de produtos
│   └── data/          # Dados da aplicação
│       └── products.json # Dados dos produtos
└── emps/             # Framework EMPS6
    ├── htdocs/       # Raiz da web
    │   ├── .htaccess # Configurações de redirecionamento
    │   └── local/    # Configuração local
    └── vendor/       # Dependências
```

## Funcionalidades

- Listagem de produtos com funcionalidade de pesquisa
- Paginação de resultados com navegação intuitiva
- Ordenação por preço e nome (crescente/decrescente)
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

## Deploy

### Frontend (Vercel)

1. Instale a CLI da Vercel:
   ```bash
   npm i -g vercel
   ```

2. Configure as variáveis de ambiente no arquivo `.env`:
   ```
   VITE_API_URL=https://seu-backend.com/api
   ```

3. Faça deploy do frontend:
   ```bash
   cd frontend
   vercel
   ```

### Backend (PHP)

O backend PHP pode ser deployado em várias plataformas:

#### Heroku
1. Crie um arquivo `Procfile`:
   ```
   web: vendor/bin/heroku-php-apache2 htdocs/
   ```

2. Deploy:
   ```bash
   heroku create
   git push heroku main
   ```

#### Railway
1. Crie um arquivo `railway.toml`:
   ```toml
   [build]
   builder = "nixpacks"
   buildCommand = "composer install"

   [deploy]
   startCommand = "php -S 0.0.0.0:$PORT -t htdocs/"
   ```

2. Deploy usando a CLI do Railway ou GitHub integration

#### Servidor Tradicional
1. Configure um servidor web (Apache/Nginx)
2. Configure o PHP e as extensões necessárias
3. Faça upload dos arquivos para o servidor
4. Configure o domínio e SSL

## Pontos Finais da API

### GET /api/produtos.php

Retorna uma lista de produtos com paginação e ordenação.

**Parâmetros de Consulta:**
- `search` (opcional): Filtra os produtos pelo nome
- `page` (opcional, padrão: 1): Número da página atual
- `per_page` (opcional, padrão: 6): Itens por página
- `sort_by` (opcional, padrão: "preco"): Campo para ordenação ("preco" ou "nome")
- `sort_order` (opcional, padrão: "asc"): Ordem de classificação ("asc" ou "desc")

**Exemplo de Resposta:**
```json
{
  "data": [
    {
      "id": 1,
      "nome": "Camiseta Branca",
      "descricao": "100% algodão, unissex",
      "preco": 59.90
    },
    ...
  ],
  "pagination": {
    "total": 24,
    "per_page": 6,
    "current_page": 1,
    "total_pages": 4
  }
}
```

## Tecnologias Utilizadas

- Vue.js 3
- Tailwind CSS
- PHP 8.2
- Framework EMPS6