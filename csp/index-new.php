<?php
session_start();

// File to log POST data
$logfile = 'data.txt';

// File to track timestamps for rate limiting
$rateLimitFile = 'rate_limit.txt';

// Maximum number of transactions per minute
$maxTransactions = 20;

// Time limit in seconds (1 minute)
$timeLimit = 60;

// Time to wait for the lock in seconds
$lockWaitTime = 3;

// Get the current timestamp
$currentTimestamp = time();

// Function to check rate limit
function checkRateLimit($rateLimitFile, $maxTransactions, $timeLimit, $currentTimestamp) {
    // Read the existing timestamps from the rate limit file
    if (file_exists($rateLimitFile)) {
        $timestamps = file($rateLimitFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        $timestamps = [];
    }

    // Filter out timestamps older than $timeLimit seconds
    $timestamps = array_filter($timestamps, function($timestamp) use ($currentTimestamp, $timeLimit) {
        return ($currentTimestamp - $timestamp) <= $timeLimit;
    });

    // Check if the number of recent transactions exceeds the limit
    if (count($timestamps) >= $maxTransactions) {
        return false;
    }

    // Add the current timestamp to the list
    $timestamps[] = $currentTimestamp;

    // Save the updated timestamps back to the file
    file_put_contents($rateLimitFile, implode(PHP_EOL, $timestamps) . PHP_EOL);

    return true;
}

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

// Check if the request is within the rate limit
if (checkRateLimit($rateLimitFile, $maxTransactions, $timeLimit, $currentTimestamp)) {
    // Open the logfile for appending
    $fileHandle = fopen($logfile, 'a');
    if ($fileHandle) {
        // Attempt to acquire the lock
        $lockAcquired = acquireLock($fileHandle, $lockWaitTime);

        // Write the data regardless of the lock status
        $data = json_encode($_POST) . PHP_EOL;
        fwrite($fileHandle, $data);

        // Release the lock if we were the one who set it
        if ($lockAcquired) {
            releaseLock($fileHandle);
        }

        echo "Data logged successfully.";

        // Close the file handle
        fclose($fileHandle);
    } else {
        echo "Unable to open the log file.";
    }
} else {
    // Return a 429 Too Many Requests response
    http_response_code(429);
    echo "Rate limit exceeded. Please try again later.";
}

