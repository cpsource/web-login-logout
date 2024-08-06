<?php
if ($argc != 3) {
    echo "Usage: php tasker_helper_update_task.php <id> <response>";
    exit(1);
}

$id = $argv[1];
$response = $argv[2];

try {
    $db = new SQLite3('/var/www/data/tasker.db', SQLITE3_OPEN_READWRITE);
    $stmt = $db->prepare("UPDATE taskers SET response = :response, flag = 2 WHERE id = :id");
    $stmt->bindValue(':response', $response, SQLITE3_BLOB);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    $db->close();

    echo "Task $id updated successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

