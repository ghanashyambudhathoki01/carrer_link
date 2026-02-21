<?php

use App\Models\JobListing;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- ACTIVE JOBS DETAILS ---\n";
$jobs = JobListing::active()->with(['employer', 'category'])->get();
foreach ($jobs as $job) {
    echo "ID: {$job->id} | Title: {$job->title} | Employer: " . ($job->employer?->name ?? 'N/A') . " | Cat: " . ($job->category?->name ?? 'N/A') . " | Status: {$job->status}\n";
}
echo "Total Active: " . $jobs->count() . "\n";
