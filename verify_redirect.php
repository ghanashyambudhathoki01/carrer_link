<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

function testRedirect($email) {
    global $app;
    $user = User::where('email', $email)->first();
    Auth::login($user);
    
    $request = Request::create('/dashboard', 'GET');
    $response = $app->handle($request);
    
    echo "Testing redirect for: $email ({$user->role})\n";
    echo "  - Redirect URL: " . $response->headers->get('Location') . "\n";
    Auth::logout();
}

echo "--- REDIRECT VERIFICATION ---\n";
testRedirect('superadmin@careerlink.com');
testRedirect('admin@careerlink.com');
testRedirect('employer@careerlink.com');
echo "--- END ---\n";
