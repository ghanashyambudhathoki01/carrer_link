<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    $status = $kernel->call('migrate', ['--force' => true]);
    echo "Migration Status: $status\n";
    echo $kernel->output();
} catch (Exception $e) {
    echo "Migration failed with exception:\n";
    echo $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
?>
