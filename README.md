# Books
Crud de livros, autores e assuntos.

## Tecnologias utilizadas
### Backend
- Containers Docker
- Framework Laravel 12 (PHP 8.3)
- Banco de dados MySQL
- Gerenciador de requisições HTTP Nginx

### Frontend
- Templates HTML Laravel blade
- JavaScript Vanilla + JQuery
- Biblioteca CSS Bootstrap 5.3

## Configurando a aplicação
### Criar certificado SSL

Será necessário criar um certificado auto assinado para conexão HTTPS local. Para isso, navegue até a pasta `./server/ssl` e execute o comando:

```bash
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout server.key -out server.crt -subj "/CN=localhost"
```

### Variáveis de ambiente

Crie o arquivo ```.env``` a partir do arquivo exemplo ```.env.example```. Navegue até a pasta raiz do projeto e execute o comando:

```bash
cp ./app/.env.example ./app/.env
```

### Containers

Na pasta raiz do projeto, execute o comando:

```bash
docker compose up -d --build
```

### Dependências

Baixe as dependências da aplicaração com o comando:

```bash
./scripts/run composer update
```

### Hash da aplicação

É necessário definir a hash da aplicação nas variáveis de ambiente. Para isso, no diretório raiz, execute o comando:

```bash
./scripts/run php artisan key:generate
```

### Migração

Crie as tabelas no banco de dados com o comando:

```bash
./scripts/run php artisan migrate
```

### Dados

Caso queira dados fictícios para testar a aplicação, execute o comando:

```bash
./scripts/run php artisan db:seed
```