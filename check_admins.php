<?php

use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- ADMIN & SUPER ADMIN LIST ---\n";
$users = User::whereIn('role', ['admin', 'super_admin'])->get();
foreach ($users as $user) {
    echo "Role: [{$user->role}] | Email: {$user->email} | Name: {$user->name}\n";
}
echo "Total: " . $users->count() . "\n";
echo "--- END ---\n";
