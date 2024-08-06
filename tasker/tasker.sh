#!/bin/bash

# Define the log file
LOG_FILE="/var/log/tasker/tasker.log"

# Function to log messages
log_message() {
    local MESSAGE="$1"
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $MESSAGE" >> "$LOG_FILE"
}

# Check if the script is already running
if pidof -x "$(basename "$0")" -o $$ >/dev/null; then
    log_message "Error: Script is already running."
    exit 1
fi

# Main script logic
log_message "Script started."

# Your script's main logic goes here
# For example:
# echo "Doing some work..."

# End of script
log_message "Script finished."
exit 0

