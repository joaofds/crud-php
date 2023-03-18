<?php

require_once __DIR__ . './../app/autoload.php';
require_once __DIR__ . './../config/config.php';

if (!session_id()) {
    session_start();
}
