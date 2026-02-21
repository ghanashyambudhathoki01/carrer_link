<?php

use App\Models\JobListing;
use App\Models\JobCategory;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- CATEGORY DIAGNOSTIC ---\n";
$categories = JobCategory::all();
foreach ($categories as $cat) {
    echo "ID: {$cat->id} | Name: {$cat->name} | Active: " . ($cat->is_active ? "YES" : "NO") . " | Icon: {$cat->icon}\n";
}

echo "\n--- JOB -> CATEGORY LINKS ---\n";
$jobs = JobListing::active()->get();
foreach ($jobs as $job) {
    echo "Job ID: {$job->id} | Category ID: {$job->category_id} | Category Name: " . ($job->category?->name ?? 'NULL') . "\n";
}
