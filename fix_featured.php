<?php

use App\Models\JobListing;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Featured Jobs Diagnostic ---\n";
$featuredCount = JobListing::active()->featured()->count();
echo "Total active featured jobs: $featuredCount\n";

if ($featuredCount === 0) {
    echo "No featured jobs found. Marking 3 recent active jobs as featured...\n";
    $jobs = JobListing::active()->latest()->take(3)->get();
    foreach ($jobs as $job) {
        $job->update(['is_featured' => true]);
        echo "  - Marked Job ID {$job->id} ('{$job->title}') as featured.\n";
    }
} else {
    echo "Featured jobs already exist:\n";
    $jobs = JobListing::active()->featured()->get();
    foreach ($jobs as $job) {
        echo "  - ID: {$job->id} | Title: {$job->title}\n";
    }
}
echo "Done.\n";
