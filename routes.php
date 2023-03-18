<?php

/**
 *
 * Aqui vão todas as nossas rotas
 * https://github.com/bramus/router
 *
 */

$router = new \Bramus\Router\Router();

$router->setNamespace('\App\Controllers');
$router->get('/home', 'Home@index');
$router->get('/produto', 'Produto@index');

$router->run();
