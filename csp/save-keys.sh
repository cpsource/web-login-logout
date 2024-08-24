#!/bin/bash

# Script to save SSL certificate files into a specified directory structure.
# It copies the following files into the appropriate ./ssl/ directory:
#   - /etc/ssl/ca-bundle.crt (renamed to ca_bundle.crt)
#   - /etc/ssl/certificate.crt
#   - /etc/ssl/private/private.key
# The script will create the necessary directories if they do not already exist.
# It preserves the file permissions and ownership of the copied files.
# Additionally, it changes the permissions and ownership of the ./ssl/private
# directory to match those of /etc/ssl/private.
# Before exiting, it will also diff the copied files against the originals.

# Function to display help message
function display_help() {
    echo "Usage: $0 [options]"
    echo
    echo "Options:"
    echo "  -h, --help    Show this help message and exit."
    exit 0
}

# Parse command line arguments
if [[ "$1" == "-h" || "$1" == "--help" ]]; then
    display_help
fi

# Check if the script is run as root
if [ "$EUID" -ne 0 ]; then
    echo "This script must be run as root. Exiting."
    exit 1
fi

# Define source and destination variables
src_ssl="/etc/ssl"
src_private="/etc/ssl/private"
dst_ssl="./ssl"
dst_private="./ssl/private"

# Create the ./ssl/private directory structure if it doesn't exist
if [ ! -d "$dst_private" ]; then
    mkdir -p "$dst_private"
    echo "Created directory $dst_private"
else
    echo "Directory $dst_private already exists"
fi

# Copy /etc/ssl/ca-bundle.crt to ./ssl as ca_bundle.crt, preserving permissions and ownership
if [ -f "$src_ssl/ca-bundle.crt" ]; then
    cp --preserve=mode,ownership "$src_ssl/ca-bundle.crt" "$dst_ssl/ca_bundle.crt"
    echo "Copied $src_ssl/ca-bundle.crt to $dst_ssl/ca_bundle.crt with permissions and ownership preserved"
else
    echo "$src_ssl/ca-bundle.crt not found"
fi

# Copy /etc/ssl/certificate.crt to ./ssl, preserving permissions and ownership
if [ -f "$src_ssl/certificate.crt" ]; then
    cp --preserve=mode,ownership "$src_ssl/certificate.crt" "$dst_ssl/"
    echo "Copied $src_ssl/certificate.crt to $dst_ssl/ with permissions and ownership preserved"
else
    echo "$src_ssl/certificate.crt not found"
fi

# Copy /etc/ssl/private/private.key to ./ssl/private, preserving permissions and ownership
if [ -f "$src_private/private.key" ]; then
    cp --preserve=mode,ownership "$src_private/private.key" "$dst_private/"
    echo "Copied $src_private/private.key to $dst_private/ with permissions and ownership preserved"
else
    echo "$src_private/private.key not found"
fi

# Change permissions, owner, and group of ./ssl/private to match /etc/ssl/private
if [ -d "$src_private" ]; then
    src_mode=$(stat -c "%a" "$src_private")
    src_owner=$(stat -c "%u" "$src_private")
    src_group=$(stat -c "%g" "$src_private")

    chmod "$src_mode" "$dst_private"
    chown "$src_owner:$src_group" "$dst_private"
    
    echo "Changed permissions of $dst_private to match $src_private"
    echo "Changed owner and group of $dst_private to match $src_private"
else
    echo "Source directory $src_private not found"
fi

# Perform diff on the files to ensure they match
echo "Performing diff on the files to verify they are identical..."

diff "$src_ssl/ca-bundle.crt" "$dst_ssl/ca_bundle.crt" && echo "ca_bundle.crt files match." || echo "ca_bundle.crt files differ."
diff "$src_ssl/certificate.crt" "$dst_ssl/certificate.crt" && echo "certificate.crt files match." || echo "certificate.crt files differ."
diff "$src_private/private.key" "$dst_private/private.key" && echo "private.key files match." || echo "private.key files differ."

# Report completion
echo "Script completed successfully."

