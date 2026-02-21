<?php

use App\Models\JobListing;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- EMPLOYER EMAILS FOR ACTIVE JOBS ---\n";
$jobs = JobListing::active()->with('employer')->get();
foreach ($jobs as $job) {
    echo "Job ID: {$job->id} | Employer Email: " . ($job->employer?->email ?? 'NONE') . "\n";
}
echo "Total Active: " . $jobs->count() . "\n";
