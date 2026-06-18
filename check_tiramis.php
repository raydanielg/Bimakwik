<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$columns = DB::select('PRAGMA table_info(tir_amis_reports)');
foreach ($columns as $col) {
    if ($col->name === 'claim_id') {
        echo 'claim_id: type=' . $col->type . ' notnull=' . $col->notnull . PHP_EOL;
    }
}
