#!/bin/bash

# Script to create /var/www/csp directory, copy index.php to that directory,
# make index.php executable, and report the actions taken.
# The script checks for root privileges before proceeding.
# If the script is not run as root, it exits with an error message.
# The script also provides a help option.

# Function to display help message
function display_help() {
    echo "Usage: $0 [options]"
    echo
    echo "Options:"
    echo "  -h, --help    Show this help message and exit."
    exit 0
}

# Check if the script is run as root
if [ "$EUID" -ne 0 ]; then
    echo "This script must be run as root. Exiting."
    exit 1
fi

# Parse command line arguments
if [[ "$1" == "-h" || "$1" == "--help" ]]; then
    display_help
fi

# Check if the directory /var/www/csp exists, if not, create it
if [ ! -d /var/www/csp ]; then
    mkdir -p /var/www/csp
    echo "Created directory /var/www/csp"
else
    echo "Directory /var/www/csp already exists"
fi

# Copy index.php to /var/www/csp and make it executable
if [ -f index.php ]; then
    cp index.php /var/www/csp/
    chmod +x /var/www/csp/index.php
    echo "Copied index.php to /var/www/csp and made it executable"
else
    echo "index.php file not found in the current directory"
    exit 1
fi

# Report completed actions
echo "Script completed successfully."

