#!/bin/bash

# Function to display help message
show_help() {
    echo "Usage: $0 <venv>"
    echo "Example: $0 my-venv"
    exit 1
}

# Check if exactly one argument (venv string) is provided
if [ $# -ne 1 ]; then
    echo "Error: Missing venv string."
    show_help
fi

# Assign the first command-line argument to a variable
VENV=$1

# Check if .git directory already exists
if [ -d ".git" ]; then
    echo "Error: This directory is already a Git repository."
    exit 1
fi

# Check if README.md already exists
if [ ! -f "README.md" ]; then
    echo "# $VENV" >> README.md
else
    echo "README.md already exists. Skipping README.md creation."
fi

# Proceed with the rest of the script
git init
git add .
git commit -m "initial release"
git branch -M main
git remote add origin git@github.com:cpsource/$VENV.git

# Push to remote repository and capture any errors
if ! git push -u origin main; then
    echo "Error: Failed to push to the remote repository."
    exit 1
fi

# Print success message
echo "Git repository initialized and pushed to remote origin: git@github.com:cpsource/$VENV.git"

