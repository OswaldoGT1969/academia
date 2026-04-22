<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Filament\Panel;

$adminEmail = env('FILAMENT_ADMIN_EMAIL');
echo "Configured Admin Email: " . $adminEmail . "\n";

// Test 1: Check Admin User
$adminUser = User::where('email', $adminEmail)->first();
if ($adminUser) {
    echo "Admin User (ID {$adminUser->id}) Access: " . ($adminUser->canAccessPanel(new Panel()) ? 'ALLOWED (Correct)' : 'DENIED (Incorrect)') . "\n";
} else {
    echo "Admin user not found in DB!\n";
}

// Test 2: Check Non-Admin User
$otherUser = User::where('email', '!=', $adminEmail)->first();
if ($otherUser) {
    echo "Non-Admin User (ID {$otherUser->id}, Email {$otherUser->email}) Access: " . ($otherUser->canAccessPanel(new Panel()) ? 'ALLOWED (Incorrect)' : 'DENIED (Correct)') . "\n";
} else {
    echo "No non-admin user found to test.\n";
}
