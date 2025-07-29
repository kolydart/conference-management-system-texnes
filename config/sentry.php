<?php

return [
    'dsn' => env('SENTRY_LARAVEL_DSN'),

    // capture release as git sha
    // 'release' => trim(exec('git log --pretty="%h" -n1 HEAD')),

    // Send default PII like user info
    'send_default_pii' => false,

    // Environment
    'environment' => env('APP_ENV', 'production'),
];
