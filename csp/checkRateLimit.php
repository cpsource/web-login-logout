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
        // If the lock could not be acquired, fail-open and allow the request
        fclose($fileHandle);
        return true;
    }
}

