<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$request = Request::create('/jobs', 'GET');
$response = $app->handle($request);

echo "--- JOBS INDEX RENDER TEST ---\n";
echo "Status Code: " . $response->getStatusCode() . "\n";
$content = $response->getContent();

if (strpos($content, '6 Jobs Found') !== false) {
    echo "Count '6 Jobs Found' FOUND in HTML!\n";
} else {
    echo "Count '6 Jobs Found' NOT FOUND in HTML.\n";
}

if (strpos($content, 'Senior Laravel') !== false) {
    echo "Job title 'Senior Laravel' FOUND in HTML!\n";
} else {
    echo "Job title 'Senior Laravel' NOT FOUND in HTML.\n";
}
?>
