<?php

/**
 *
 * Aqui vão todas as nossas rotas
 * https://github.com/bramus/router
 *
 */

$router = new \Bramus\Router\Router();

$router->setNamespace('\App\Controllers');
$router->get('/', 'Home@index');
$router->get('/produto', 'Produto@index');

$router->run();
