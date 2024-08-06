<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tasker Status</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Tasker Status</h1>
    <?php
    try {
        // Open the SQLite3 database
        $db = new SQLite3('/var/www/data/tasker.db', SQLITE3_OPEN_READWRITE);

        // Check if there are any records in the taskers table
        $countResult = $db->querySingle('SELECT COUNT(*) FROM taskers');
        
        if ($countResult > 0) {
            // Query to fetch all records from the taskers table
            $result = $db->query('SELECT * FROM taskers');

            echo "<table>";
            echo "<tr><th>ID</th><th>Flag</th><th>Session ID</th><th>Command</th><th>Response</th></tr>";

            // Fetch and display each record
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['flag']) . "</td>";
                echo "<td>" . htmlspecialchars($row['session_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['command']) . "</td>";
                echo "<td>" . htmlspecialchars($row['response']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No records found.</p>";
        }

        // Close the database connection
        $db->close();
    } catch (Exception $e) {
        // Handle exceptions
        echo "Failed to retrieve data: " . $e->getMessage();
    }
    ?>
</body>
</html>

