<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Importing travel.sql database...\n";

try {
    // Read the SQL file
    $sqlFile = file_get_contents('database/travel.sql');

    if ($sqlFile === false) {
        throw new Exception("Could not read database/travel.sql file");
    }

    echo "SQL file loaded successfully!\n";

    // Split SQL file into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sqlFile)));

    echo "Found " . count($statements) . " SQL statements to execute\n";

    // Execute each statement
    $successCount = 0;
    $errorCount = 0;

    foreach ($statements as $statement) {
        if (empty($statement) || strpos($statement, '--') === 0) {
            continue; // Skip empty lines and comments
        }

        try {
            DB::statement($statement);
            $successCount++;
        } catch (Exception $e) {
            echo "Error executing statement: " . substr($statement, 0, 50) . "...\n";
            echo "Error: " . $e->getMessage() . "\n";
            $errorCount++;
        }
    }

    echo "\nImport completed!\n";
    echo "Successful statements: $successCount\n";
    echo "Failed statements: $errorCount\n";

    // Verify admin user exists
    $adminUser = DB::select('SELECT * FROM user WHERE username = "admin" LIMIT 1');

    if (!empty($adminUser)) {
        echo "\n✓ Admin user found in database!\n";
        echo "Username: " . $adminUser[0]->username . "\n";
        echo "Email: " . $adminUser[0]->user_email . "\n";
        echo "Type: " . $adminUser[0]->type . "\n";
        echo "Password (plain): 12345678\n";

    } else {
        echo "\n⚠ Admin user not found. You may need to run setup_admin.php\n";
    }

    echo "\nDatabase import completed!\n";
    echo "You can now login at: http://localhost/admin.php\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nPlease make sure:\n";
    echo "1. Your .env file is configured correctly\n";
    echo "2. The 'travel' database exists in MySQL\n";
    echo "3. Your MySQL server is running\n";
}

echo "\n";