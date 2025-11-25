<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Changing admin password to 'okri2311'...\n";

$newPassword = 'okri2311';
$hashedPassword = md5($newPassword);

echo "New password: $newPassword\n";
echo "MD5 hash: $hashedPassword\n";

try {
    // Update admin user password
    $updated = DB::update('UPDATE user SET user_password = ? WHERE username = "admin"', [$hashedPassword]);

    if ($updated > 0) {
        echo "✓ Admin password updated successfully!\n";

        // Verify the update
        $adminUser = DB::select('SELECT user_id, username, user_email, type FROM user WHERE username = "admin" LIMIT 1');

        if (!empty($adminUser)) {
            echo "\nAdmin User Info:\n";
            echo "ID: " . $adminUser[0]->user_id . "\n";
            echo "Username: " . $adminUser[0]->username . "\n";
            echo "Email: " . $adminUser[0]->user_email . "\n";
            echo "Type: " . $adminUser[0]->type . "\n";
        }

        echo "\n✓ You can now login with:\n";
        echo "Username: admin\n";
        echo "Password: okri2311\n";
        echo "URL: http://localhost/admin.php\n";

    } else {
        echo "⚠ Admin user not found! Let's create it...\n";

        // Create admin user if it doesn't exist
        $inserted = DB::insert('INSERT INTO user (user_email, user_mobile, user_password, username, name, type) VALUES (?, ?, ?, ?, ?, ?)', [
            'admin@gmail.com',
            '+625455649685',
            $hashedPassword,
            'admin',
            'Okri',
            'admin'
        ]);

        if ($inserted) {
            echo "✓ Admin user created successfully!\n";
            echo "Username: admin\n";
            echo "Password: okri2311\n";
            echo "URL: http://localhost/admin.php\n";
        }
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nPlease make sure:\n";
    echo "1. Your .env file is configured correctly\n";
    echo "2. The 'travel' database exists in MySQL\n";
    echo "3. Your MySQL server is running\n";

    echo "\nAlternatively, you can manually run this SQL in phpMyAdmin:\n";
    echo "UPDATE user SET user_password = '$hashedPassword' WHERE username = 'admin';\n";
}

echo "\n";