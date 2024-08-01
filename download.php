<?php

/*
 * From the mother ship:
 *
 * File Path Update
 * Ensure to update the $filePath variable in download.php to the actual path where your files are stored.
 * For example, if your files are stored in a directory named downloads, you can set the path like this:

  $filePath = 'downloads/' . $file;
 */

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = 'path/to/your/files/' . $file;

    if (file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'No file specified.';
}
?>

