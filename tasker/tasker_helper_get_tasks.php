<?php
try {
    $db = new SQLite3('/var/www/data/tasker.db', SQLITE3_OPEN_READWRITE);
    $result = $db->query("SELECT id, session_id, command FROM taskers WHERE flag = 0");

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo $row['id'] . '|' . $row['session_id'] . '|' . $row['command'] . "\n";
    }

    $db->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

