#!/bin/bash

# Define the log file
LOG_FILE="/var/log/tasker/tasker"
DB_PATH="/var/www/data/tasker.db"

# Function to log messages
log_message() {
    local MESSAGE="$1"
    echo "$(date '+%Y-%m-%d %H:%M:%S') - $MESSAGE" >> "$LOG_FILE"
}

# Function to check if the script is already running
is_already_running() {
    if pidof -x "$(basename "$0")" -o $$ >/dev/null; then
        log_message "Error: Script is already running."
        exit 1
    fi
}

# Function to clean up tasks with flag = 3
cleanup_tasks() {
    # Fetch tasks with flag = 3 from the database
    TASKS=$(php /var/www/html/tasker/tasker_helper_get_cleanup_tasks.php)

    if [ -z "$TASKS" ]; then
        log_message "No tasks with flag = 3 found for cleanup."
        return
    fi

    # Process each task
    echo "$TASKS" | while read -r TASK; do
        IFS='|' read -r ID SESSION_ID <<< "$TASK"

        # Remove directory for the session
        SESSION_DIR="/var/www/data/$SESSION_ID"
        if [ -d "$SESSION_DIR" ]; then
            rm -rf "$SESSION_DIR"
            log_message "Removed directory $SESSION_DIR for task $ID."
        fi

        # Remove the task from the database
        php /var/www/html/tasker/tasker_helper_delete_task.php "$ID"
        log_message "Task $ID with flag = 3 deleted from the database."
    done
}

# Function to process tasks with flag = 0
process_tasks() {
    # Fetch tasks with flag = 0 from the database
    TASKS=$(php /var/www/html/tasker/tasker_helper_get_tasks.php)

    if [ -z "$TASKS" ]; then
        log_message "No tasks with flag = 0 found."
        return
    fi

    # Process each task
    echo "$TASKS" | while read -r TASK; do
        IFS='|' read -r ID SESSION_ID COMMAND <<< "$TASK"

        # Create directory for the session
        SESSION_DIR="/var/www/data/$SESSION_ID"
        mkdir -p "$SESSION_DIR"

        # Write command to a script in the session directory
        SCRIPT_PATH="$SESSION_DIR/command.sh"
        echo "$COMMAND" > "$SCRIPT_PATH"
        chmod +x "$SCRIPT_PATH"

        # Execute the script and capture the output
        OUTPUT=$(bash "$SCRIPT_PATH" 2>&1)

        # Update the database with the response
        php /var/www/html/tasker/tasker_helper_update_task.php "$ID" "$OUTPUT"
        log_message "Task $ID processed."
    done
}

# Main script execution
is_already_running
log_message "Script started."
cleanup_tasks
process_tasks
log_message "Script finished."
exit 0

