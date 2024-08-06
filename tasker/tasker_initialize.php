<?php
try {
    $dbPath = '/var/www/data/tasker.db';

    // Check if the database already exists
    if (file_exists($dbPath)) {
        echo "Database already exists. Exiting.";
        exit(0);
    }

    // Create (or open) the SQLite3 database with SQLITE3_OPEN_READWRITE flag
    $db = new SQLite3($dbPath, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

    // SQL statement to create the 'taskers' table
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS taskers (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            flag INTEGER,
            session_id CHAR(32),
            command CHAR(255),
            response BLOB
        );
    ";

    // Execute the SQL statement
    $db->exec($createTableSQL);

    // Confirm table creation
    echo "Database and table 'taskers' created successfully.";

    // Close the database connection
    $db->close();
} catch (Exception $e) {
    // Handle exceptions
    echo "Failed to create database or table: " . $e->getMessage();
}
?>

