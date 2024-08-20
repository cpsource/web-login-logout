#!/bin/bash

# Function to display help message
# This function is called when the user does not provide the correct number of arguments.
show_help() {
    echo "Usage: $0 <source_directory> <destination_directory>"
    echo "Example: $0 /path/to/src /path/to/dst"
    exit 1
}

# Check if exactly two arguments are provided.
# If not, display an error message and show the help.
if [ $# -ne 2 ]; then
    echo "Error: Missing arguments."
    show_help
fi

# Assign the first and second command-line arguments to variables.
SRC_DIR=$1
DST_DIR=$2

# Check if the source directory exists.
# If it doesn't exist, display an error message and exit the script.
if [ ! -d "$SRC_DIR" ]; then
    echo "Error: Source directory '$SRC_DIR' does not exist."
    exit 1
fi

# Check if the destination directory exists.
# If it doesn't exist, display an error message and exit the script.
if [ ! -d "$DST_DIR" ]; then
    echo "Error: Destination directory '$DST_DIR' does not exist."
    exit 1
fi

# Use the tar command to copy the contents of the source directory to the destination directory.
# The -C option changes the directory before performing the tar operation.
tar cf - -C "$SRC_DIR" . | tar xf - -C "$DST_DIR"

# If the tar command succeeds, display a success message.
echo "Successfully copied from '$SRC_DIR' to '$DST_DIR'."

