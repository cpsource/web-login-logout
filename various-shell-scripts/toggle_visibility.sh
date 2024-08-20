#!/bin/bash

# Function to display help message
show_help() {
    echo "Usage: $0 <invisible|visible>"
    echo "invisible: Removes all files and directories except the .git directory."
    echo "visible: Restores all files and directories from the latest commit."
    exit 1
}

# Check if the .git directory exists in the current directory
if [ ! -d ".git" ]; then
    echo "Error: This directory is not a Git repository (no .git directory found)."
    exit 1
fi

# Check if exactly one argument is provided
if [ $# -ne 1 ]; then
    echo "Error: Missing or incorrect argument."
    show_help
fi

# Check the first argument
if [ "$1" == "invisible" ]; then
    echo "Making files invisible..."
    
    # Remove all files and directories except .git
    find . -path ./\.git -prune -o -exec rm -rf {} +
    
    echo "All files and directories have been removed except the .git directory."

elif [ "$1" == "visible" ]; then
    echo "Restoring files from the latest commit..."
    
    # Restore all files from the latest commit
    git checkout -- .
    
    echo "All files and directories have been restored from the latest commit."

    # Uncomment the following line to restore from a specific commit
    # Replace <commit-hash> with the actual commit hash.
    # git checkout <commit-hash> -- .
    
else
    echo "Error: Invalid argument."
    show_help
fi

