#!/bin/bash

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
            rm -f $files
        fi
    done
}

# Export the function so that it can be used by find
export -f cleanup_logs

# Find all directories in log_dir and apply the cleanup function
find "$log_dir" -type d -exec bash -c 'cleanup_logs "$0"' {} \;

