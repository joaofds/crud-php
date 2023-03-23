# CRUD de Vendas

Pequena aplicação MVC com Active Record com rotinas de venda de produtos

## Como Rodar o Projeto.

Na raiz do projeto e dentro da pasta `/config/database.php` você encontra o arquivo de configuração do banco, basta informar os dados e já está configurado.

Também é necessário fazer a restauração do banco que está dentro da pasta `/sql` na raiz do projeto.

Esse arquivo está predefinido para o drive PostgreSQL:

```php // template.php
const DATA_LAYER_CONFIG = [
    'driver' => 'pgsql',
    'host' => '127.0.0.1',
    'port' => '5432',
    'dbname' => 'seu_banco',
    'username' => 'postgres',
    'passwd' => 'sua_senha',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];
```

Instalar as dependências do composer na raiz do projeto (Requer PHP 7.4+).

```bash
composer install
```

Navegar até a pasta `/public`, rodar o servidor built-in do PHP e acessar localhost:8080 no seu navegador.

```bash
php -S localhost:8080
```

## Libs

- **[Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)**
- **[JQuery](https://api.jquery.com/)**
- **[Select2](https://select2.org/)**
- **[Awesome Fonts 4.7](https://fontawesome.com/v4/icons/)**
- **[bramus/router](https://github.com/bramus/router)**
- **[Blade Template](https://github.com/EFTEC/BladeOne)**

.....god bless you
