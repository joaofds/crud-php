<?php

const DATA_LAYER_CONFIG = [
    'driver' => 'pgsql',
    'host' => '127.0.0.1',
    'port' => '5432',
    'dbname' => 'mercado',
    'username' => 'postgres',
    'passwd' => 'root',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];
