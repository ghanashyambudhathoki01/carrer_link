<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$request = Request::create('/', 'GET');
$response = $app->handle($request);

echo "--- HOME PAGE RENDER TEST ---\n";
echo "Status Code: " . $response->getStatusCode() . "\n";
$content = $response->getContent();

if (strpos($content, '6+') !== false) {
    echo "Stats '6+' FOUND in HTML!\n";
} else {
    echo "Stats '6+' NOT FOUND in HTML.\n";
}

if (strpos($content, 'Senior Laravel') !== false) {
    echo "Job title 'Senior Laravel' FOUND in HTML!\n";
} else {
    echo "Job title 'Senior Laravel' NOT FOUND in HTML.\n";
}

if (strpos($content, '⭐ Featured Jobs') !== false) {
    echo "Section 'Featured Jobs' FOUND in HTML!\n";
} else {
    echo "Section 'Featured Jobs' NOT FOUND in HTML.\n";
}

if (strpos($content, 'UI/UX Designer') !== false) {
    echo "Job title 'UI/UX Designer' FOUND in HTML!\n";
} else {
    echo "Job title 'UI/UX Designer' NOT FOUND in HTML.\n";
}

echo "HTML Length: " . strlen($content) . "\n";
?>
