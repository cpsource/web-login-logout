<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SQLite3 Example</title>
</head>
<body>
    <h1>SQLite3 Database Example</h1>
    <?php
    // Try to open the SQLite3 database
    try {
        // Path to the SQLite3 database file
        $dbPath = '/var/www/data/users.db';

        $db = new SQLite3($dbPath);

        // Create a table if it doesn't exist
        $db->exec('CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY, message TEXT)');

        // Insert a record with "Hello, World!"
        $db->exec("INSERT INTO messages (message) VALUES ('Hello, World!')");

        // Confirm the insertion
        echo "<p>Record inserted successfully.</p>";

        // Close the database connection
        $db->close();
    } catch (Exception $e) {
        // Handle the exception if the connection fails
        echo "Failed to connect to the database: " . $e->getMessage();
    }
    ?>
</body>
</html>

