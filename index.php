<?php

require __DIR__ . '/vendor/autoload.php';
### .env
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

### start session
session_start();

### Routing
require __DIR__ . '/src/routes.php';





