<?php
if ($argc != 2) {
    echo "Usage: php tasker_helper_delete_task.php <id>";
    exit(1);
}

$id = $argv[1];

try {
    $db = new SQLite3('/var/www/data/tasker.db', SQLITE3_OPEN_READWRITE);
    $stmt = $db->prepare("DELETE FROM taskers WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    $db->close();

    echo "Task $id deleted successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

