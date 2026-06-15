<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TIRAMIS (TIRA MIS) Integration Configuration
    |--------------------------------------------------------------------------
    */

    'enabled' => env('TIRAMIS_ENABLED', false),

    'mode' => env('TIRAMIS_MODE', 'sandbox'), // sandbox | production

    'endpoints' => [
        'sandbox' => env('TIRAMIS_SANDBOX_URL', 'https://sandbox.tira.go.tz/api/v1'),
        'production' => env('TIRAMIS_PRODUCTION_URL', 'https://tira.go.tz/api/v1'),
    ],

    'credentials' => [
        'username' => env('TIRAMIS_USERNAME', ''),
        'password' => env('TIRAMIS_PASSWORD', ''),
        'api_key' => env('TIRAMIS_API_KEY', ''),
    ],

    'timeout' => env('TIRAMIS_TIMEOUT', 30),

    'retry_on_failure' => env('TIRAMIS_RETRY', true),

    'max_retries' => env('TIRAMIS_MAX_RETRIES', 3),

    'report_types' => [
        'claims' => 'Claims Report',
        'policies' => 'Policies Report',
        'premiums' => 'Premiums Report',
        'commissions' => 'Commissions Report',
        'aggregate' => 'Aggregate Market Report',
    ],

    'default_report_type' => env('TIRAMIS_DEFAULT_REPORT', 'claims'),

    'sync_interval' => env('TIRAMIS_SYNC_INTERVAL', 'daily'),

    'company_code_prefix' => env('TIRAMIS_COMPANY_PREFIX', 'TZ'),

    'sales_code_prefix' => env('TIRAMIS_SALES_PREFIX', 'SL'),
];
