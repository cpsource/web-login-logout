<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSP Report Listener</title>
</head>
<body>
<?php

function logCspReport(array $report, string $logFilePath = 'csp-reports.log'): void
{
    try {
        // Convert the report array to JSON
        $jsonReport = convertReportToJson($report);

        // Append the JSON report to the log file
        appendToFile($logFilePath, $jsonReport);

    } catch (Exception $e) {
        // Handle exceptions (e.g., log them to a different file, send an alert, etc.)
        handleLoggingError($e);
    }
}

function convertReportToJson(array $report): string
{
    return json_encode($report);
}

function appendToFile(string $filePath, string $data): void
{
    $success = file_put_contents($filePath, $data . PHP_EOL, FILE_APPEND | LOCK_EX);

    // Check if file_put_contents was successful
    if ($success === false) {
        throw new Exception('Failed to write to the log file: ' . $filePath);
    }
}

function handleLoggingError(Exception $e): void
{
    // For example, log the error to a separate file or take other actions
    file_put_contents('error-log.log', $e->getMessage() . PHP_EOL, FILE_APPEND | LOCK_EX);
    // Additional error handling can be added here
}

// Example usage:
//$report = [
//    'csp-report' => [
//        'document-uri' => 'https://example.com',
//        'referrer' => '',
//        'blocked-uri' => 'https://malicious.com',
//        'violated-directive' => 'script-src',
//        'original-policy' => "default-src 'self'; script-src 'self' https://example.com",
//    ]
// ];

//logCspReport($report);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Extract the 'csp-report' field
    $report = isset($data['csp-report']) ? $data['csp-report'] : null;

    if ($report) {
        // Log to a specific log file
        logCspReport($report);
        //file_put_contents('csp-reports.log', json_encode($report) . PHP_EOL, FILE_APPEND | LOCK_EX);

        // Print the report to the screen (for debugging purposes)
        //echo '<pre>CSP Violation: ' . htmlspecialchars(json_encode($report, JSON_PRETTY_PRINT)) . '</pre>';
    } else {
        file_put_contents('error-log.log', "index.php reports NULL" . PHP_EOL, FILE_APPEND | LOCK_EX);
        file_put_contents('csp-reports.log', json_encode($data) . PHP_EOL, FILE_APPEND | LOCK_EX);
    }


    // Return a 204 No Content response
    http_response_code(204);
    exit();
}
?>
    <h1>CSP Report Listener</h1>
    <p>This page is used to receive and log CSP reports in /var/www/csp/csp-reports.log.</p>
</body>
</html>

