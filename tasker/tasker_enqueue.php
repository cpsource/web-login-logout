<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Enqueue</title>
    <style>
        form {
            margin: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Enqueue Task</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $command = isset($_POST['command']) ? trim($_POST['command']) : '';

        if (strlen($command) <= 255) {
            try {
                // Open the SQLite3 database
                $db = new SQLite3('/var/www/data/tasker.db', SQLITE3_OPEN_READWRITE);

                // Generate a session ID
                session_start();
                $session_id = session_id();

                // Prepare and execute the SQL statement to insert the new task
                $stmt = $db->prepare('INSERT INTO taskers (flag, session_id, command, response) VALUES (:flag, :session_id, :command, :response)');
                $stmt->bindValue(':flag', 0, SQLITE3_INTEGER);
                $stmt->bindValue(':session_id', $session_id, SQLITE3_TEXT);
                $stmt->bindValue(':command', $command, SQLITE3_TEXT);
                $stmt->bindValue(':response', '', SQLITE3_BLOB);
                $stmt->execute();

                // Close the database connection
                $db->close();

                echo "<p>Task Queued</p>";
            } catch (Exception $e) {
                // Handle exceptions
                echo "Failed to enqueue task: " . $e->getMessage();
            }
        } else {
            echo "<p>Command must be 255 characters or less.</p>";
        }
    }
    ?>
    <form method="post" action="">
        <label for="command">Command (up to 255 chars):</label>
        <input type="text" id="command" name="command" required maxlength="255">
        <input type="submit" value="Enqueue Task">
    </form>
 <?php include 'footer.php'; ?>
</body>
</html>

