<?php
// Path to the SQLite3 database file
$dbPath = '/var/www/data/users.db';

// Create the data directory if it does not exist
if (!file_exists('/var/www/data')) {
    mkdir('/var/www/data', 0777, true);
}

// Create the database if it does not exist
$db = new SQLite3($dbPath);

// Create the users table if it does not exist
$query = 'CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    date_accessed DATE NOT NULL,
    session_id CHAR(20) NOT NULL,
    email_address TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    login_level CHAR(255) NOT NULL
)';

$db->exec($query);

echo "Database and table created successfully!";
?>

