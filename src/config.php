<?php

require __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

// Carregue as variáveis de ambiente - safe
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();