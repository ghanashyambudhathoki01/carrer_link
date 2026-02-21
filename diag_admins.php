<?php

use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Admin Users Diagnostic ---\n";
$admins = User::whereIn('role', ['admin', 'super_admin'])->get();
foreach ($admins as $u) {
    echo "ID: {$u->id} | Role: {$u->role} | Email: {$u->email}\n";
}
echo "Done.\n";
