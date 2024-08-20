#!/bin/bash

# Function to display help message
# This function is called when the user does not provide the correct number of arguments.
show_help() {
    echo "Usage: $0 <directory1> <directory2>"
    echo "Example: $0 /path/to/dir1 /path/to/dir2"
    exit 1
}

# Check if exactly two arguments are provided.
# If not, display an error message and show the help.
if [ $# -ne 2 ]; then
    echo "Error: Missing arguments."
    show_help
fi

# Assign the first and second command-line arguments to variables.
DIR1=$1
DIR2=$2

# Check if the first directory exists.
# If it doesn't exist, display an error message and exit the script.
if [ ! -d "$DIR1" ]; then
    echo "Error: Directory '$DIR1' does not exist."
    exit 1
fi

# Check if the second directory exists.
# If it doesn't exist, display an error message and exit the script.
if [ ! -d "$DIR2" ]; then
    echo "Error: Directory '$DIR2' does not exist."
    exit 1
fi

# Use the diff command with --brief to compare the directories and display differences.
# The --brief option shows only whether files differ, not the specific differences.
DIFF_OUTPUT=$(diff --brief -r "$DIR1" "$DIR2")

# Display the diff output.
echo "$DIFF_OUTPUT"

# Count the number of different files by counting the lines in the diff output.
DIFF_COUNT=$(echo "$DIFF_OUTPUT" | wc -l)

# Display the number of different files.
echo "Number of different files: $DIFF_COUNT"

