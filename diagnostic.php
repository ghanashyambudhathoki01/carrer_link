<?php

use App\Models\JobListing;
use App\Models\JobCategory;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- Job Visibility Diagnostic ---\n";
echo "Current Time: " . now()->toDateTimeString() . "\n";
echo "Timezone: " . config('app.timezone') . "\n";
echo "Total Jobs: " . JobListing::count() . "\n";

$jobs = JobListing::all();
foreach ($jobs as $job) {
    echo "ID: {$job->id} | Title: {$job->title}\n";
    echo "  - Status: '{$job->status}' (Match 'approved': " . ($job->status === 'approved' ? "YES" : "NO") . ")\n";
    echo "  - Deadline: " . ($job->deadline ? $job->deadline->toDateTimeString() : "NULL") . " (Is Future/Today: " . ($job->deadline === null || $job->deadline->isFuture() || $job->deadline->isToday() ? "YES" : "NO") . ")\n";
    echo "  - Passes scopeActive: " . (JobListing::active()->find($job->id) ? "YES" : "NO") . "\n";
    echo "---------------------------------\n";
}

$categories = JobCategory::where('is_active', true)->get();
echo "Active Categories Count: " . $categories->count() . "\n";
foreach ($categories as $cat) {
    echo "  - ID: {$cat->id} | Name: {$cat->name}\n";
}
