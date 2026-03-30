<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'adminauth'     => \App\Filters\AdminAuth::class,
    ];

    public array $globals = [
        'before' => [
            'csrf' => ['except' => ['api/leads/create']],
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    // IMPORTANT: Remove the global adminauth filter from here
    // We'll apply it in routes instead with exceptions
    public array $filters = [
        // 'adminauth' => ['before' => ['admin/*', 'admin']],  // REMOVE THIS LINE
    ];
}