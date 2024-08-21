#!/bin/bash

# This script checks the /var/log directory and all its subdirectories for compressed log files (*.gz).
# If there are more than four of any type of log file, the script will keep only the four most recent
# files and delete the older ones. 
# The script must be run as root to ensure it has the necessary permissions to delete log files.
# If the script is not run as root, it will display an error message and exit.

# Ensure the script is run as root
if [ "$EUID" -ne 0 ]; then
  echo "This script must be run as root. Please use sudo."
  echo "Example: sudo $0"
  exit 1
fi

# Directory to check
log_dir="/var/log"

# Function to process each directory
cleanup_logs() {
    local dir=$1
    
    # Loop through all types of .gz files in the current directory
    for file_type in $(find "$dir" -maxdepth 1 -name "*.gz" 2>/dev/null | rev | cut -d'.' -f3- | rev | uniq); do
        # Get a list of all .gz files for the current file type, sorted by modification time (oldest first)
        files=$(ls -1t ${file_type}*.gz 2>/dev/null | tail -n +5)
        
        # If there are more than 4 files, delete the older ones
        if [ $(echo "$files" | wc -l) -gt 0 ]; then
            echo "Deleting older files of type ${file_type} in ${dir}:"
            echo "$files"
            rm $files
        fi
    done
}

# Export the function so that it can be used by find
export -f cleanup_logs

# Find all directories in log_dir and apply the cleanup function
find "$log_dir" -type d -exec bash -c 'cleanup_logs "$0"' {} \;

