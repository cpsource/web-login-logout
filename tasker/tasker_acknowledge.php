<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Acknowledge</title>
    <style>
        form {
            margin: 20px 0;
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
    <h1>Task Acknowledge</h1>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $task_id = isset($_POST['task_id']) ? trim($_POST['task_id']) : '';

        if (!empty($task_id) && is_numeric($task_id)) {
            try {
                $db = new SQLite3('/var/www/data/tasker.db', SQLITE3_OPEN_READWRITE);

                // Look up the task by ID
                $stmt = $db->prepare("SELECT flag FROM taskers WHERE id = :id");
                $stmt->bindValue(':id', $task_id, SQLITE3_INTEGER);
                $result = $stmt->execute();
                $row = $result->fetchArray(SQLITE3_ASSOC);

                if ($row) {
                    if ($row['flag'] == 2) {
                        // Update the flag from 2 to 3
                        $updateStmt = $db->prepare("UPDATE taskers SET flag = 3 WHERE id = :id");
                        $updateStmt->bindValue(':id', $task_id, SQLITE3_INTEGER);
                        $updateStmt->execute();

                        echo "<p>Task ID $task_id updated from flag 2 to 3.</p>";
                    } else {
                        echo "<p>Task ID $task_id does not have a flag value of 2.</p>";
                    }
                } else {
                    echo "<p>No task found with ID $task_id.</p>";
                }

                // Close the database connection
                $db->close();
            } catch (Exception $e) {
                echo "Failed to update task: " . $e->getMessage();
            }
        } else {
            echo "<p>Please enter a valid numeric task ID.</p>";
        }
    }
    ?>
    <form method="post" action="">
        <label for="task_id">Task ID:</label>
        <input type="text" id="task_id" name="task_id" required>
        <input type="submit" value="Acknowledge Task">
    </form>
</body>
</html>

