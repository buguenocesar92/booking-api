<?php

return [
    'paths' => ['api/*', 'auth/*'],  // Asegúrate de incluir los endpoints que usas
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'], // O ['*'] para desarrollo, pero cuidado en producción
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
