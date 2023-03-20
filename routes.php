<?php

/**
 *
 * Aqui vão todas as nossas rotas
 * https://github.com/bramus/router
 *
 */

$router = new \Bramus\Router\Router();

$router->setNamespace('\App\Controllers');

// HOME
$router->get('/', 'Home@index');

// PRODUTO
$router->get('/produtos', 'Produto@index');
$router->get('/produtos/cadastrar', 'Produto@create');
$router->post('/produtos/salvar', 'Produto@store');

// CATEGORIAS
$router->get('/categorias', 'Categoria@index');
$router->get('/categorias/cadastrar', 'Categoria@create');
$router->post('/categorias/salvar', 'Categoria@store');

$router->run();
