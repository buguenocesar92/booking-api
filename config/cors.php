<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    // Especifica el origen exacto de tu frontend
    'allowed_origins' => ['http://localhost:3000', 'http://localhost:5173'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    // Activa el soporte de credenciales para enviar cookies
    'supports_credentials' => true,
];
