<?php

/*
 * This web page receives any CSP exceptions and logs them
 */

?>
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
session_start();

// File to log POST data
$logfile = 'csp-reports.log';

// File to track timestamps for rate limiting
$rateLimitFile = 'rate_limit.txt';

// Maximum number of transactions per minute
$maxTransactions = 20;

// Time limit in seconds (1 minute)
$timeLimit = 60;

// Time to wait for the lock in seconds
$lockWaitTime = 2;

// Get the current timestamp
$currentTimestamp = time();

// Function to acquire a lock on the file
function acquireLock($fileHandle, $lockWaitTime) {
    $startTime = microtime(true);

    do {
        // Try to acquire an exclusive lock (LOCK_EX)
        if (flock($fileHandle, LOCK_EX | LOCK_NB)) {
            // Lock acquired
            return true;
        }
        // Sleep for a short while before trying again
        usleep(100000); // 100 milliseconds
    } while (microtime(true) - $startTime < $lockWaitTime);

    // Failed to acquire lock within $lockWaitTime
    return false;
}

// Function to release a lock on the file
function releaseLock($fileHandle) {
    return flock($fileHandle, LOCK_UN);
}

/**
 * checkRateLimit - Enforces a rate limit on transactions.
 * 
 * This function reads and updates a rate limit file that tracks the number of transactions
 * occurring within a specified time window (e.g., 1 minute). The file format is <count> <time>,
 * where:
 * - <count> is the number of transactions that have occurred within the last minute.
 * - <time> is the timestamp of the most recent transaction.
 * 
 * How the function works:
 * 1. The function attempts to open the rate limit file in read/write mode. If the file doesn't exist,
 *    it creates a new one.
 * 2. It acquires an exclusive lock on the file to ensure that only one process can update the file at
 *    a time.
 * 3. Once the lock is acquired, the function reads the current transaction count and timestamp from the file.
 * 4. The function checks if the stored timestamp is older than the specified time limit (e.g., 1 minute).
 *    - If it is older, the function resets the transaction count to 1 and updates the timestamp to the current time.
 *    - If it is within the time limit, the function increments the transaction count by 1.
 * 5. The function updates the file with the new transaction count and timestamp.
 * 6. The lock is released, and the file is closed.
 * 7. The function returns true if the current transaction count is within the allowed limit, and false if the limit is exceeded.
 * 
 * If the function is unable to open the file or acquire the lock, it defaults to allowing the transaction (fail-open).
 *
 * @param string $rateLimitFile The file used to track transaction counts and timestamps.
 * @param int $maxTransactions The maximum number of allowed transactions within the time limit.
 * @param int $timeLimit The time limit in seconds (e.g., 60 seconds for 1 minute).
 * @param int $currentTimestamp The current timestamp when the request is processed.
 * @return bool Returns true if the transaction is within the allowed limit, otherwise false.
 */
function checkRateLimit($rateLimitFile, $maxTransactions, $timeLimit, $currentTimestamp) {
    // Open the rate limit file for reading and writing
    $fileHandle = fopen($rateLimitFile, 'c+');

    if (!$fileHandle) {
        // If the file cannot be opened, allow the request (fail-open)
        return true;
    }

    // Attempt to acquire the lock
    $lockAcquired = acquireLock($fileHandle, $lockWaitTime);

    if ($lockAcquired) {
        // Read the current <count> <time> from the file
        $fileContents = trim(fgets($fileHandle));
        list($count, $lastTimestamp) = explode(' ', $fileContents . ' 0 0');

        $count = (int)$count;
        $lastTimestamp = (int)$lastTimestamp;

        // Check if the time is more than a minute old
        if (($currentTimestamp - $lastTimestamp) > $timeLimit) {
            // If more than a minute has passed, reset the count
            $count = 1;
            $lastTimestamp = $currentTimestamp;
        } else {
            // Otherwise, increment the count
            $count++;
        }

        // Rewind the file pointer to the beginning of the file
        rewind($fileHandle);

        // Update the file with the new count and timestamp
        ftruncate($fileHandle, 0);
        fwrite($fileHandle, $count . ' ' . $lastTimestamp . PHP_EOL);

        // Release the lock
        releaseLock($fileHandle);

        // Close the file
        fclose($fileHandle);

        // Check if the current count exceeds the maximum allowed transactions
        return $count <= $maxTransactions;
    } else {
        // If the lock could not be acquired, fail-open
        fclose($fileHandle);
        return false;
    }
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if the request is within the rate limit
    if (checkRateLimit($rateLimitFile, $maxTransactions, $timeLimit, $currentTimestamp)) {

        // Get the JSON data from the request
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        // Extract the 'csp-report' field
        $report = isset($data['csp-report']) ? $data['csp-report'] : null;

        if ($report) {
            // Log to a specific log file
            file_put_contents($logfile, json_encode($report) . PHP_EOL, FILE_APPEND | LOCK_EX);

            // Print the report to the screen (for debugging purposes)
            //echo '<pre>CSP Violation: ' . htmlspecialchars(json_encode($report, JSON_PRETTY_PRINT)) . '</pre>';
        }

        // Return a 204 No Content response
        http_response_code(204);
        exit();
    } else {
        // Return a 429 Too Many Requests response
        http_response_code(429);
        exit();
        //  echo "Rate limit exceeded. Please try again later.";
    } //check rate limit
} // POST

?>
<h1>CSP Report Listener</h1>
<p>This page is used to receive and log CSP reports.</p>
</body>
</html>

