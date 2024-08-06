#!/bin/bash

# Define the log file
LOG_FILE="/var/log/tasker/tasker"

# Function to log messages
log_message() {
    local MESSAGE="$1"
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $MESSAGE" >> "$LOG_FILE"
}

# Function to check if the input is a valid PHP session ID
is_valid_session_id() {
    local SESSION_ID="$1"
    
    # Regular expression to match a 32-character hexadecimal string
    if [[ "$SESSION_ID" =~ ^[a-fA-F0-9]{32}$ ]]; then
        return 0
    else
        return 1
    fi
}

# Check if the script is already running
if pidof -x "$(basename "$0")" -o $$ >/dev/null; then
    log_message "Error: Script is already running."
    exit 1
fi

# Example usage of is_valid_session_id
SESSION_ID="2f6e3f9e8274a6c1d3a583b2f8f439ae"  # Replace with actual input
if is_valid_session_id "$SESSION_ID"; then
    log_message "Valid session ID: $SESSION_ID"
else
    log_message "Invalid session ID: $SESSION_ID"
fi

# Main script logic
log_message "Script started."

# Your script's main logic goes here
# For example:
# echo "Doing some work..."

# End of script
log_message "Script finished."
exit 0

