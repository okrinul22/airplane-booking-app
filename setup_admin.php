<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

echo "Setting up admin database...\n";

try {
    // Check if the database is connected
    $tables = DB::select('SHOW TABLES');
    echo "Database connected successfully!\n";

    // Check if user table exists and has admin user
    $userTable = DB::select('SELECT * FROM user WHERE username = "admin" LIMIT 1');

    if (empty($userTable)) {
        echo "Admin user not found. Creating admin user...\n";

        // Insert admin user with MD5 password (12345678)
        DB::insert('INSERT INTO user (user_email, user_mobile, user_password, username, name, type) VALUES (?, ?, ?, ?, ?, ?)', [
            'admin@gmail.com',
            '+625455649685',
            md5('12345678'), // MD5 hash of "12345678"
            'admin',
            'Okri',
            'admin'
        ]);

        echo "Admin user created successfully!\n";
        echo "Username: admin\n";
        echo "Password: 12345678\n";
    } else {
        echo "Admin user already exists!\n";
        echo "Username: admin\n";
        echo "Password: 12345678\n";

        // Update password to ensure it's correct
        DB::update('UPDATE user SET user_password = ? WHERE username = "admin"', [md5('12345678')]);
        echo "Admin password updated to ensure it's correct!\n";
    }

    // Show current admin user info
    $adminUser = DB::select('SELECT user_id, username, user_email, type FROM user WHERE username = "admin" LIMIT 1');
    if (!empty($adminUser)) {
        echo "\nAdmin User Info:\n";
        echo "ID: " . $adminUser[0]->user_id . "\n";
        echo "Username: " . $adminUser[0]->username . "\n";
        echo "Email: " . $adminUser[0]->user_email . "\n";
        echo "Type: " . $adminUser[0]->type . "\n";
    }

    echo "\nSetup completed! You can now login at:\n";
    echo "http://localhost/admin.php\n";
    echo "or\n";
    echo "http://localhost/login.php\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nPlease make sure:\n";
    echo "1. Your .env file is configured correctly\n";
    echo "2. The 'travel' database exists in MySQL\n";
    echo "3. You can manually import the database/travel.sql file using phpMyAdmin\n";
}

echo "\n";