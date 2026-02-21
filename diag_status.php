<?php

use App\Models\JobListing;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- NON-PENDING JOBS DIAGNOSTIC ---\n";
$jobs = JobListing::where('status', '!=', 'pending')->get();
foreach ($jobs as $job) {
    echo "ID: {$job->id} | Title: {$job->title} | Raw Status: '{$job->status}'\n";
    echo "  - Type of Status: " . gettype($job->status) . "\n";
    echo "  - Length of Status: " . strlen($job->status) . "\n";
}
echo "Total non-pending: " . $jobs->count() . "\n";
