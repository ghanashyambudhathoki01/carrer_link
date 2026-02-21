<?php

use App\Models\JobListing;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- STATUS CASING DIAGNOSTIC ---\n";
$jobs = JobListing::all();
foreach ($jobs as $job) {
    echo "ID: {$job->id} | Title: {$job->title} | Raw Status: '{$job->status}'\n";
    echo "  - Exact 'approved' (lowercase): " . ($job->status === 'approved' ? "YES" : "NO") . "\n";
    echo "  - Case-insensitive 'approved': " . (strtolower($job->status) === 'approved' ? "YES" : "NO") . "\n";
}
