<?php

// Configura para mostrar erros todos os erros.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Timezone padão Brasil.
date_default_timezone_set('America/Sao_Paulo');

// Inicio sessão se não existe.
if (!session_id()) {
    session_start();
}
